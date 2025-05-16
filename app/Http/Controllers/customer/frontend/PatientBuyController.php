<?php

namespace App\Http\Controllers\customer\frontend;

use App\Components\System;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Patient;
use App\Models\Patient_payments;
use App\Models\Patient_payment_items;
use App\Models\Patient_payment_logs;
use App\Rules\QuantityAvailable;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Components\InventoryPatient;

class PatientBuyController extends Controller
{
    public function __construct()
    {
        $this->system = new System();
        $this->iventory = new InventoryPatient();
    }

    public function index(Request $request)
    {
        $product_id = $request->product;
        $keyword = $request->keyword;
        $start_date = !empty($request->start_date) ? implode('-', array_reverse(explode(' / ', $request->start_date))) : '' ;
        $end_date = !empty($request->end_date) ? implode('-', array_reverse(explode(' / ', $request->end_date))) : '' ;

        $customer_id = Auth::guard('customer')->user()->id;
        $fcSystem = $this->system->fcSystem();
        $detail =  Customer::getCustomer($customer_id);
        $products = Product::getAllProductOption()->toArray();

        $data = Patient_payments::where(['customer_id' => $customer_id])->orderBy('id', 'desc');
        if( $keyword ) {
            $data = $data->where('title', 'like', '%' . $keyword . '%');
        }
        if( $product_id > 0 ) {
            $data = $data->whereHas('payment_items', function ($query) use ($product_id) {
                $query->where('product_id', $product_id);
            });
        }
        if( !empty($start_date) && !empty($end_date) ) {
            $data = $data->where('created_at', '>=', $start_date . ' 00:00:00')->where('created_at', '<=', $end_date . ' 23:59:59');
        } elseif ( !empty($start_date) ) {
            $data = $data->where('created_at', '>=', $start_date . ' 00:00:00');
        } elseif ( !empty($end_date) ) {
            $data = $data->where('created_at', '<=', $end_date . ' 23:59:59');
        }
        // Tìm kiếm theo sản phẩm
        $data = $data->with(['payment_items' => function ($query) use ($product_id) {
            if( $product_id > 0 ) {
                $query->where(['product_id' => $product_id]);
            }
        }]);

        $data = $data->paginate(20);

        if (is($product_id)) {
            $data->appends(['product' => $product_id]);
        }
        if (is($keyword)) {
            $data->appends(['keyword' => $keyword]);
        }
        if (is($start_date)) {
            $data->appends(['start_date' => $start_date]);
        }
        if (is($end_date)) {
            $data->appends(['end_date' => $end_date]);
        }

        $seo['canonical'] = url('/');
        $seo['meta_title'] = 'Danh sách đặt hàng';
        $seo['meta_description'] = 'Danh sách đặt hàng';
        $seo['meta_image'] = '';
        return view('customer/frontend/patient/order/index', compact('fcSystem',  'seo', 'detail', 'data', 'products'));
    }

    public function create(Request $request)
    {
        $fcSystem = $this->system->fcSystem();
        $detail =  Customer::getCustomer(Auth::guard('customer')->user()->id);
        $products = Product::getAllProductOption()->toArray();
        $seo['canonical'] = url('/');
        $seo['meta_title'] = 'Thêm mới đơn hàng';
        $seo['meta_description'] = 'Thêm mới đơn hàng';
        $seo['meta_image'] = '';
        return view('customer/frontend/patient/order/create', compact('fcSystem', 'detail', 'seo', 'products'));
    }

    public function store(Request $request)
    {
        // Giá trị nhập
        $products = $request->products;
        $quantities = $request->quantities;

        $request->validate([
            'title' => 'required',
        ], [
            'title.required' => 'Mô tả là trường bắt buộc.',
        ]);

        // Giá trị max số lượng theo sản phẩm
        $maxQuantities = Product::getQtyProductArrId(array_map('intval', $products));
        $titles = Product::getTitleProductArrId(array_map('intval', $products));

        // Thực hiện validate
        foreach ($products as $index => $productId) {
            $quantity = (int) ($quantities[$index] ?? 0);
            $maxAllowed = $maxQuantities[$productId] ?? 0;
            $title = $titles[$productId] ?? 0;

            if ($quantity > $maxAllowed) {
                $errors["quantities.$index"] = "Số lượng răng của sản phẩm '{$title}' không được vượt quá {$maxAllowed}.";
            }
        }
        if (!empty($errors)) {
            return back()->withErrors($errors)->withInput();
        }
        $this->submit($request, 'create');
        return redirect()->route('patientBuy.index')->with('success', "Thêm mới đơn hàng thành công");
    }

    public function submit($request = [], $action = '', $id = 0)
    {
        $products = array_map('intval', $request->products);
        $quantities = $request->quantities;

        // Thực hiện thêm đơn hàng vào bảng `patient_payments`
        $_data_patient_payments = [
            'title' => $request->title,
            'customerid_created' => Auth::guard('customer')->user()->id,
            'created_at' => Carbon::now(),
        ];
        if( $action == 'create' ) {
            $id = Patient_payments::insertGetId($_data_patient_payments);

            // Thực hiện data đơn hàng `patient_payment_items`
            foreach ( $products as $key => $product_id ){
                $dataJson = Product::getDataProduct($product_id, ['id', 'title', 'quantity']);
                $_data_patient_payment_items = [
                    'payment_id' => $id,
                    'customer_id' => Auth::guard('customer')->user()->id,
                    'quantity' => $quantities[$key],
                    'product_id' => $product_id,
                    'data_json' => json_encode($dataJson),
                ];
                $id_item = Patient_payment_items::insertGetId($_data_patient_payment_items);

                // Thực hiện cập nhật lại số lượng trong sản phẩm
                $detailProduct = Product::getProductById($product_id);
                $_qty_update = $detailProduct->quantity - $quantities[$key];
                $detailProduct->update(['quantity' => $_qty_update]);

                // Thực hiện ghi log
                $_log = [
                    'customer_id' => Auth::guard('customer')->user()->id,
                    'quantity' => $quantities[$key],
                    'product_id' => $product_id,
                    'note' => 'Thêm mới số lượng '.$quantities[$key],
                    'created_at' => Carbon::now(),
                ];
                Patient_payment_logs::create($_log);
            }
        }
    }

    public function searchProducts(Request $request)
    {
        $id = (int)$request->id;
        $product = Product::getProductById($id);
        return response()->json($product);
    }
}
