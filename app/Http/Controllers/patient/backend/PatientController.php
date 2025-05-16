<?php

namespace App\Http\Controllers\patient\backend;

use App\Components\Nestedsetbie;
use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\PatientLog;
use App\Models\Patient_payment_items;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Components\Helper;
use App\Components\Polylang;
use App\Models\CategoryPatient;
use App\Models\Tag;
use Illuminate\Validation\Rule;
use App\Http\Requests\PostRequest;
use App\Components\InventoryPatient;

class PatientController extends Controller
{
    protected $Nestedsetbie;
    protected $Helper;
    protected $Polylang;
    protected $table = 'patients';
    public function __construct()
    {
        $this->Helper = new Helper();
        $this->Polylang = new Polylang();
    }
    public function index(Request $request)
    {
        $module = $this->table;
        $keyword = $request->keyword;
        $time_start = $request->time_start;
        $time_end = $request->time_end;
        $product_id = $request->product;

        $data =  Patient::where(['alanguage' => config('app.locale'), 'trash' => 0])
            ->with(['user:id,name', 'customer.customer_catalogue', 'productDetail'])
            ->orderBy('order', 'ASC')
            ->orderBy('id', 'DESC');

        if (!empty($keyword)) {
            $data =  $data->where($this->table . '.name', 'like', '%' . $keyword . '%');
        }
        if( !empty($time_start) && !empty($time_start) ){
            $data =  $data->where($this->table . '.created_at', '>=', $time_start .' 00:00:00')->where($this->table . '.created_at', '<=', $time_end .' 23:59:59');
        } else if( !empty($time_start) ) {
            $data =  $data->where($this->table . '.created_at', '>=', $time_start .' 00:00:00');
        } else if( !empty($time_end) ){
            $data =  $data->where($this->table . '.created_at', '<=', $time_end .' 23:59:59');
        }

        // Tìm kiếm theo sản phẩm
        if( $product_id > 0 ) {
            $data = $data->where('product', $product_id);
        }
        $data =  $data->paginate(env('APP_paginate'));
        if (is($keyword)) {
            $data->appends(['keyword' => $keyword]);
        }
        if (is($time_start)) {
            $data->appends(['time_start' => $time_start]);
        }
        if (is($time_end)) {
            $data->appends(['time_end' => $time_end]);
        }
        if (is($product_id)) {
            $data->appends(['product_id' => $product_id]);
        }
//        dd($data);
        $products = Product::getAllProductOption();
        $configIs = \App\Models\Configis::select('title', 'type')->where(['module' => $this->table, 'active' => 1])->get();
        return view('patient.backend.patient.index', compact('data', 'module', 'configIs', 'products'));
    }
    public function create()
    {
        $dropdown = getFunctions();
        $module = $this->table;
        $action = 'create';
        //tags
        $getTags = [];
        if (old('tags')) {
            $getTags = old('tags');
        }
        //end tag
        $products = dropdown(\App\Models\Product::select('id', 'title')->where('alanguage', config('app.locale'))->orderBy('order', 'asc')->orderBy('id', 'desc')->get(), 'Chọn sản phẩm', 'id', 'title');
        $field = \App\Models\ConfigColum::where(['trash' => 0, 'publish' => 0, 'module' => $module])->get();
        return view('patient.backend.patient.create', compact('module', 'dropdown', 'action', 'field', 'products'));
    }
    public function store(Request $request)
    {
        if( !isset($request->product) ) {
            return redirect()->back()->withErrors(['product' => 'Sản phẩm là trường bắt buộc']);
        }
        $maxQty = 1000;
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
        if (!empty($request->file('image'))) {
            $image_url = uploadImageNone($request->file('image'), 'patients');
        } else {
            $image_url = $request->image_old;
        }
        $this->submit($request, 'create', 0, $image_url);
        return redirect()->route('patients.index')->with('success', "Thêm mới bài viết thành công");
    }
    public function edit($id)
    {
        $dropdown = getFunctions();
        $module = $this->table;
        $action = 'update';
        $detail  = Patient::find($id);
        if (!isset($detail)) {
            return redirect()->route('patients.index')->with('error', "Bài viết không tồn tại");
        }
        $getProduct = [];
        if (old('product')) {
            $getProduct = old('product');
        } else {
            $getProduct = json_decode($detail->product);
        }
        $maxQty = '';
        $detail  = Patient::find($id);
        if( $detail->customerid_created > 0 ) {
            $totalAllPatient = (int)Patient_payment_items::getTotalQty($detail->product, Auth::guard('customer')->user()->id); // Tổng tất cả số lượng răng
            $usedPatient = (int)Patient::getTotalQtyBought($detail->product, Auth::guard('customer')->user()->id); // Tổng số lượng răng đã sử dụng
            $maxQty = $totalAllPatient - $usedPatient;
        }
        $field = \App\Models\ConfigColum::where(['trash' => 0, 'publish' => 0, 'module' => $module])->get();
        $products = dropdown(\App\Models\Product::select('id', 'title')->where('alanguage', config('app.locale'))->orderBy('order', 'asc')->orderBy('id', 'desc')->get(), 'Chọn sản phẩm', 'id', 'title');
        return view('patient.backend.patient.edit', compact('module', 'detail', 'action', 'field', 'products', 'getProduct', 'maxQty'));
    }
    public function update(Request $request, $id)
    {
        $maxQty = '';
        $detail  = Patient::find($id);
        if( $detail->customerid_created > 0 ) {
            $totalAllPatient = (int)Patient_payment_items::getTotalQty($request->product, Auth::guard('customer')->user()->id); // Tổng tất cả số lượng răng
            $usedPatient = (int)Patient::getTotalQtyBought($request->product, Auth::guard('customer')->user()->id); // Tổng số lượng răng đã sử dụng
            $maxQty = $totalAllPatient - $usedPatient;
        }

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
        //upload image
        if (!empty($request->file('image'))) {
            $image_url = uploadImage($request->file('image'), 'patients');
        } else {
            $image_url = $request->image_old;
        }
        //end
        $this->submit($request, 'update', $id, $image_url);
        return redirect()->route('patients.index')->with('success', "Cập nhập bài viết thành công");
    }
    
    public function submit($request = [], $action = '', $id = 0, $image_url = '')
    {
        if ($action == 'create') {
            $time = 'created_at';
            $user = 'userid_created';
        } else {
            $time = 'updated_at';
            $user = 'userid_updated';
        }
        $quantity = $request['quantity'];
        $_data = [
            'name' => $request['name'],
            'code' => is($request['code']),
            'product' => (int)$request['product'],
            'quantity' => $quantity,
            'meta_title' => $request['title'],
            'publish' => 0,
            'installation_date' => $request['installation_date'],
            'expiration_date' => $request['expiration_date'],
            $user => Auth::user()->id,
            $time => Carbon::now(),
            'alanguage' => config('app.locale'),
        ];
        if ($action == 'create') {
            $id = Patient::insertGetId($_data);
        } else {
            Patient::find($id)->update($_data);
        }
        if (!empty($id)) {
            //xóa khi cập nhập
            if ($action == 'update') {
                //xóa custom fields
                DB::table('config_postmetas')->where(['module_id' => $id, 'module' => $this->table])->delete();
                $this->Polylang->insert($this->table, $request['language'], $id);
            }
            //START: custom fields
            fieldsInsert($this->table, $id, $request);
            //END
        }
    }

    public function check( PostRequest $request ){
        $params = $request->validated();
    }

    public function log( Request $request ) {
        $module = 'patients';
        $date_start = '';
        $date_end = '';
        if( isset($request->date) ){
            $date = explode(' to ', $request->date);
            $date_start = $date[0].' 00:00:00';
            $date_end = $date[1].' 23:59:59';
        }
        $data =  PatientLog::with(['user', 'customer']);
        if( !empty($date_start) && !empty($date_end) ) {
            $data = $data->where('created_at', '>=', $date_start . ' 00:00:00')->where('created_at', '<=', $date_end . ' 23:59:59');
        }
        $data =  $data->orderBy('id', 'desc')->paginate(20);
        if (is($request->date)) {
            $data->appends(['date' => $request->date]);
        }
        return view('patient.backend.logs.index', compact('module', 'data'));
    }


    // Ajax lấy chi tiết sản phẩm
    public function getDetailProduct(Request $request) 
    {
        $id = $request->id;
        $product = $this->getProduct($id);
        return response()->json($product);
    }
}
