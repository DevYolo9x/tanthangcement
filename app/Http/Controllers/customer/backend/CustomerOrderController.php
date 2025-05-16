<?php

namespace App\Http\Controllers\customer\backend;

use App\Components\Nestedsetbie;
use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\PatientLog;
use App\Models\Patient_payments;
use App\Models\Patient_payment_items;
use App\Models\Product;
use App\Models\Customer;
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

class CustomerOrderController extends Controller
{
    protected $Nestedsetbie;
    protected $Helper;
    protected $Polylang;
    protected $table = 'patient_payments';
    public function __construct()
    {
        $this->Helper = new Helper();
        $this->Polylang = new Polylang();
        $this->iventory = new InventoryPatient();
    }
    public function index(Request $request, $customerID)
    {
        $module = 'customers';
        $keyword = $request->keyword;
        $time_start = $request->time_start;
        $time_end = $request->time_end;
        $product_id = $request->product;

        $products = Product::getAllProductOption();
        $data =  Patient_payments::orderBy('id', 'DESC')->where('customer_id', $customerID)->with(['user', 'payment_items']);

        if (!empty($keyword)) {
            $data =  $data->where($this->table . '.title', 'like', '%' . $keyword . '%');
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
            $data = $data->whereHas('payment_items', function ($query) use ($product_id) {
                $query->where('product_id', $product_id);
            });
        }
        $data = $data->with(['payment_items' => function ($query) use ($product_id) {
            if( $product_id > 0 ) {
                $query->where(['product_id' => $product_id]);
            }
        }]);
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
            $data->appends(['product' => $product_id]);
        }
        $configIs = \App\Models\Configis::select('title', 'type')->where(['module' => $this->table, 'active' => 1])->get();
        return view('customer.backend.customer.order.index', compact('data', 'module', 'configIs', 'customerID', 'products'));
    }

    public function create($customerID = 0)
    {
        $module = 'customers';
        $customer =  Customer::getCustomer($customerID);
        $products = Product::getAllProductOption()->toArray();
        return view('customer.backend.customer.order.create', compact('module', 'products', 'customerID', 'customer'));
    }

    public function edit(Request $request, $customerID = 0, $orderID = 0)
    {
        $detail = Patient_payments::with('payment_items')->find($orderID);
        $module = 'customers';
        $customer =  Customer::getCustomer($customerID);
        $products = Product::getAllProductOption()->toArray();
        $product_payments = Patient_payment_items::getProductIdByPaymentID($orderID);
        $data_payments = [];
        if( isset($product_payments) ) {
            foreach ( $product_payments as $k => $val ) {
                $data_payments['ids'][$k] = $val['product_id'];
                $data_payments['quantities'][$k] = $val['quantity'];
                $data_payments['payment_id'][$k] = $val['id'];
            }
        }
        return view('customer.backend.customer.order.edit', compact('module', 'products', 'customerID', 'customer', 'detail', 'data_payments'));
    }

    public function store(Request $request, $customerID = 0, $orderID = 0)
    {
        // Giá trị nhập
        $products = $request->products;
        $quantities = $request->quantities;

        $request->validate([
            'title' => 'required',
        ], [
            'title.required' => 'Mô tả là trường bắt buộc.',
        ]);

        // Thực hiện validate
        foreach ($products as $index => $productId) {
            $quantity = (int) ($quantities[$index] ?? 0);
            $title = $titles[$productId] ?? 0;

            if ($quantity <= 0) {
                $errors["quantities.$index"] = "Số lượng răng của sản phẩm phải lớn hơn 0.";
            }
        }
        if (!empty($errors)) {
            return back()->withErrors($errors)->withInput();
        }

        $this->submit($request, 0, $customerID, 'create');
        return redirect()->route('customerOrder.index', ['customerID' => $customerID])->with('success', "Thêm mới đơn hàng thành công");
    }

    public function update(Request $request, $customerID = 0, $orderID = 0)
    {
        // Giá trị nhập
        $products = $request->products;
        $quantities = $request->quantities;

        $request->validate([
            'title' => 'required',
        ], [
            'title.required' => 'Mô tả là trường bắt buộc.',
        ]);

        // Thực hiện validate
        foreach ($products as $index => $productId) {
            $quantity = (int) ($quantities[$index] ?? 0);
            $title = $titles[$productId] ?? 0;

            if ($quantity <= 0) {
                $errors["quantities.$index"] = "Số lượng răng của sản phẩm phải lớn hơn 0.";
            }
        }

        $this->submit($request, $orderID, $customerID, 'update');
        return redirect()->route('customerOrder.index', ['customerID' => $customerID])->with('success', "Thêm mới đơn hàng thành công");
    }

    public function submit($request, $orderID, $customerID = 0, $action = 'create')
    {
        $products = array_map('intval', $request->products); // Danh sách sản phẩm
        $quantities = $request->quantities; // Danh sách số lượng
        $payment_ids = $request->ids; // Danh sách id cập nhật

        if ($action == 'create') {
            $time = 'created_at';
            $user = 'userid_created';
        } else {
            $time = 'updated_at';
            $user = 'userid_updated';
        }

        // Thực hiện thêm đơn hàng vào bảng `patient_payments`
        $_data_patient_payments = [
            'title' => $request->title,
            'customer_id' => $customerID,
            $user => Auth::user()->id,
            $time => Carbon::now(),
        ];
        if( $action == 'create' ) {
            $id = Patient_payments::insertGetId($_data_patient_payments);

            // Thêm dữ liệu đơn hàng `patient_payment_items`
            foreach ( $products as $key => $product_id ){
                $dataJson = Product::getDataProduct($product_id, ['id', 'title', 'quantity']);
                $_data_patient_payment_items = [
                    'payment_id' => $id,
                    'customer_id' => $customerID,
                    'quantity' => $quantities[$key],
                    'product_id' => $product_id,
                    'data_json' => json_encode($dataJson),
                ];
                $id_item = Patient_payment_items::insertGetId($_data_patient_payment_items);
            }
        } elseif ($action = 'update') {
            Patient_payments::find($orderID)->update($_data_patient_payments);

            // Xoá item đơn hàng không thuộc mảng ids
            Patient_payment_items::where('payment_id', $orderID)->whereNotIn('id', $payment_ids)->delete();

            // Cập nhật số lượng răng đơn hàng đã tạo trước đó
            foreach ( $products as $key => $product ) {
                $dataJson = Product::getDataProduct($product, ['id', 'title', 'quantity']);
                if( isset($payment_ids[$key]) && !empty($payment_ids[$key]) && $payment_ids[$key] > 0 ) {
                    $_data_patient_payment_items = [
                        'payment_id' => $orderID,
                        'quantity' => $quantities[$key],
                        'product_id' => $product,
                        'data_json' => json_encode($dataJson),
                    ];
                    Patient_payment_items::find($payment_ids[$key])->update($_data_patient_payment_items);
                } else {
                    $_data_patient_payment_items = [
                        'payment_id' => $orderID,
                        'customer_id' => $customerID,
                        'quantity' => $quantities[$key],
                        'product_id' => $product,
                        'data_json' => json_encode($dataJson),
                    ];
                    $id_item = Patient_payment_items::insertGetId($_data_patient_payment_items);
                }
            }
        }
    }
}
