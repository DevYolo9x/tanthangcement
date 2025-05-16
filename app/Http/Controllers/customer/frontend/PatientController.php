<?php

namespace App\Http\Controllers\customer\frontend;

use App\Components\System;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Patient;
use App\Models\Patient_payment_items;
use App\Rules\QuantityAvailable;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Components\InventoryPatient;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->system = new System();
        $this->iventory = new InventoryPatient();
    }

    public function index(Request $request)
    {
        $customer_id = Auth::guard('customer')->user()->id;
        $fcSystem = $this->system->fcSystem();
        $detail =  $this->getUser();
        $data = Patient::where(['publish' => 0, 'trash' => 0, 'alanguage' => config('app.locale'), 'customerid_created' => $customer_id])->orderBy('id', 'desc');
        if (is($request->keyword)) {
            $data =  $data->where('name', 'like', '%' . $request->keyword . '%')
                ->orWhere('code', 'like', '%' . $request->keyword . '%');
        }
        $count = $data->count();
        $data = $data->paginate(20);
        if (is($request->keyword)) {
            $data->appends(['keyword' => $request->keyword]);
        }
        
        $seo['canonical'] = url('/');
        $seo['meta_title'] = 'Danh sách bệnh nhân';
        $seo['meta_description'] = 'Danh sách bệnh nhân';
        $seo['meta_image'] = '';
        return view('customer/frontend/patient/index', compact('fcSystem', 'detail', 'seo', 'data'));
    }  
    
    public function create(Request $request)
    {
        $customer_id = Auth::guard('customer')->user()->id;

        // Lấy ra danh sách sản phẩm răng đại lý đã mua
        $product_ids = Patient_payment_items::getProductIdByCustomer($customer_id)->toArray();
        $products = Product::getTitleProductArrId($product_ids); // Danh sách sp đã mua

        $fcSystem = $this->system->fcSystem();
        $detail =  $this->getUser();
        $seo['canonical'] = url('/');
        $seo['meta_title'] = 'Thêm mới bệnh nhân';
        $seo['meta_description'] = 'Thêm mới bệnh nhân';
        $seo['meta_image'] = '';
        return view('customer/frontend/patient/create', compact('fcSystem', 'detail', 'seo', 'products'));
    }
    
    public function update(Request $request, $id)
    {
        if( !isset($request->product) ) {
            return redirect()->back()->withErrors(['product' => 'Sản phẩm là trường bắt buộc']);
        }
        $maxQty = $this->iventory->getMaxQty($request->product, $id);
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'product' => 'required',
            'quantity' => ['required', 'integer', 'min:1', 'max:'.$maxQty],
            'installation_date' => 'required',
            'expiration_date' => 'required',
        ], [
            'name.required' => 'Họ và tên là trường bắt buộc.',
            'code.required' => 'Mã biên lai là trường bắt buộc.',
            'product.required' => 'Sản phẩm là trường bắt buộc.',
            'quantity.required' => 'Số lượng răng là trường bắt buộc.',
            'quantity.max' => 'Số lượng răng phải nhỏ hơn '.$maxQty,
            'installation_date.required' => 'Ngày lắp là trường bắt buộc.',
            'expiration_date.required' => 'Ngày hết hạn bảo hành là trường bắt buộc.',
        ]);
        $this->submit($request, 'update', $id);
        return redirect()->route('patient.index')->with('success', "Cập nhật bênh nhân thành công");
    }

    public function store(Request $request) 
    {
        if( !isset($request->product) ) {
            return redirect()->back()->withErrors(['product' => 'Sản phẩm là trường bắt buộc']);
        }
        $product  = Product::where(['alanguage' => config('app.locale'), 'publish' => 0])->find($request->product);
        $totalAllPatient = (int)Patient_payment_items::getTotalQty($request->product, Auth::guard('customer')->user()->id); // Tổng tất cả số lượng răng
        $usedPatient = (int)Patient::getTotalQtyBought($request->product, Auth::guard('customer')->user()->id); // Tổng số lượng răng đã sử dụng
        $maxQty = $totalAllPatient - $usedPatient;

        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'product' => 'required',
            'quantity' => ['required', 'integer', 'min:1', 'max:'.$maxQty],
            'installation_date' => 'required',
            'expiration_date' => 'required',
        ], [
            'name.required' => 'Họ và tên là trường bắt buộc.',
            'code.required' => 'Mã biên lai là trường bắt buộc.',
            'product.required' => 'Sản phẩm là trường bắt buộc.',
            'quantity.required' => 'Số lượng răng là trường bắt buộc.',
            'quantity.max' => 'Số lượng răng phải nhỏ hơn '.$maxQty,
            'installation_date.required' => 'Ngày lắp là trường bắt buộc.',
            'expiration_date.required' => 'Ngày hết hạn bảo hành là trường bắt buộc.',
        ]);
        $this->submit($request, 'create');
        return redirect()->route('patient.index')->with('success', "Thêm mới bênh nhân thành công");
    }

    public function edit($id){
        $fcSystem = $this->system->fcSystem();
        $detail =  $this->getUser();
        $data  = Patient::where(['alanguage' => config('app.locale'), 'publish' => 0])->find($id);
        if (!isset($data)) {
            return redirect()->route('patient.index')->with('error', "Bệnh nhân không tồn tại");
        }
        $product  = Product::where(['alanguage' => config('app.locale'), 'publish' => 0])->find($data->product);
        $totalAllPatient = (int)Patient_payment_items::getTotalQty($data->product, Auth::guard('customer')->user()->id); // Tổng tất cả số lượng răng
        $usedPatient = (int)Patient::getTotalQtyUsed($data->product, Auth::guard('customer')->user()->id, $id); // Tổng số lượng răng đã sử dụng loại trừ người bệnh hiện tại
        $maxQty = $totalAllPatient - $usedPatient;

        $seo['canonical'] = url('/');
        $seo['meta_title'] = 'Cập nhật bệnh nhân';
        $seo['meta_description'] = 'Cập nhật bệnh nhân';
        $seo['meta_image'] = '';
        return view('customer/frontend/patient/edit', compact('fcSystem', 'detail', 'seo', 'data', 'product', 'maxQty'));
    }
    
    public function delete(Request $request){
        $id = (int)$request->id;
        Patient::find($id)->update(['trash' => 1]);
        return response()->json(['status' => 200]);
    }

    public function submit($request = [], $action = '', $id = 0)
    {
        $installation_date = implode('-', array_reverse(explode(' / ', $request['installation_date'])));
        $expiration_date = implode('-', array_reverse(explode(' / ', $request['expiration_date'])));
        if ($action == 'create') {
            $time = 'created_at';
            $user = 'customerid_created';
        } else {
            $time = 'updated_at';
            $user = 'customerid_updated';
        }
        $quantity = isset($request['quantity']) ? str_replace('.', '', $request['quantity']) : 0;
        $_data = [
            'name' => $request['name'],
            'code' => is($request['code']),
            'product' => (int)$request['product'],
            'quantity' => $quantity,
            'meta_title' => $request['title'],
            'publish' => 0,
            'installation_date' => $installation_date,
            'expiration_date' => $expiration_date,
            $user => Auth::guard('customer')->user()->id,
            $time => Carbon::now(),
            'alanguage' => config('app.locale'),
        ];
        if( $action == 'create' ) {
            $id = Patient::insertGetId($_data);
            // Cập nhật lại tồn só lượng tồn kho của sản phẩm và ghi log
            //$this->iventory->updateQtyProduct($request['product'], $id, $quantity, $action, 'frontend');
        } else {
            $patient = $this->getPatient($id);
            // Cập nhật lại tồn só lượng tồn kho của sản phẩm và ghi log
            //$this->iventory->updateQtyProduct($request['product'], $id, $quantity, $action, 'frontend');
            $patient->update($_data);
        }
    }

    // Ajax tìm kiếm sản phẩm select2
    public function searchProducts(Request $request) 
    {
        $keyword = $request->q;
        if (strlen($keyword) < 3) {
            return response()->json([]);
        }
        $data = Product::where(['alanguage' => config('app.locale'), 'publish' => 0])->where('title', 'like', '%' . $keyword . '%')->get();
        return response()->json($data);
    }
    
    // Ajax lấy max số lượng răng đại lý đã mua
    public function getMaxPatient(Request $request)
    {
        $product_id = $request->id;
        $customer_id = Auth::guard('customer')->user()->id;
        $max = Patient_payment_items::getTotalQty($product_id, $customer_id); // Tổng tất cả số lượng răng đại lý đã mua theo sản phẩm
        $buy = Patient::getTotalQtyBought($product_id, $customer_id); // Tổng số lượng răng đại lý đã bán theo sản phẩm
        $result = [
            'max' => $max,
            'buy' => $buy,
            'val' => $max - $buy,
        ];
        return response()->json($result);
    }
    
    // Lấy thông tin bệnh nhân
    public function getPatient($id)
    {
        return Patient::where(['alanguage' => config('app.locale'), 'publish' => 0])->find($id);
    }

    // Lấy thông tin user
    public function getUser() 
    {
        return Customer::find(Auth::guard('customer')->user()->id); 
    }
}
