<?php

namespace App\Components;

use View;
use Cache;
use App\Models\Product;
use App\Models\Patient;
use App\Models\PatientLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class InventoryPatient
{
    public function __construct()
    {
    }

    // Cập nhật lại số lượng răng trong sản phẩm khi thêm mới
    public function updateQtyProduct($product_id, $patient_id, $qtyInput, $action, $location = '')
    {
        $patient = $this->getPatient($patient_id);
        $product = $this->getProduct($product_id);
        $logs = [
            'product_id' => $product_id,
            'patient_id' => $patient_id,
            'created_at' => Carbon::now(),
        ];

        if( $location == 'backend' ) {
            $logs['user_id'] = Auth::user()->id;
        } else if( $location == 'frontend' ) {
            $logs['customer_id'] = Auth::guard('customer')->user()->id;
        }

        if( $action == 'create' ) {
            $qtyUpdate = $product->quantity - $patient->quantity;
            $logs['note'] = 'Thêm mới số lượng: '.$patient->quantity;
            $logs['type'] = 'create';
        } else {
            $qtyUpdate = $product->quantity + $patient->quantity - $qtyInput;
            $logs['note'] = 'Cập nhật số lượng từ '.$patient->quantity.' -> '.$qtyInput;
            $logs['type'] = 'update';
        }
        // Cập nhật
        $product->update(['quantity' => $qtyUpdate]);
        // Tạo log
        PatientLog::create($logs);
    }

    public function createDeleteCustomer($id) 
    {
        $patient = $this->getPatient($id);
        $product = $this->getProduct($patient->product);
        $logs = [
            'note' => 'Đã xoá bệnh nhân: '.$patient->name,
            'customer_id' => Auth::guard('customer')->user()->id,
            'product_id' => $product->id,
            'patient_id' => $patient->id,
            'created_at' => Carbon::now(),
            'type' => 'delete',
        ];
        PatientLog::create($logs);
    }
    
    public function createDeleteUser($id) 
    {
        $patient = $this->getPatient($id);
        $product = $this->getProduct($patient->product);
        $logs = [
            'note' => 'Đã xoá bệnh nhân: '.$patient->name,
            'user_id' => Auth::user()->id,
            'product_id' => $product->id,
            'patient_id' => $patient->id,
            'created_at' => Carbon::now(),
            'type' => 'delete',
        ];
        PatientLog::create($logs);
    }

    // Lấy tổng số răng có thể cập nhật lại
    public function getMaxQty($product_id, $patient_id)
    {
        $patient = $this->getPatient($patient_id);
        $product = $this->getProduct($product_id);
        return ($product->quantity + $patient->quantity);
    }

    // Lấy thông tin sản phẩm
    public function getProduct($id)
    {
        return Product::where(['alanguage' => config('app.locale'), 'publish' => 0])->find($id);
    }
    
    // Lấy thông tin bệnh nhân
    public function getPatient($id)
    {
        return Patient::where(['alanguage' => config('app.locale'), 'publish' => 0])->find($id);
    }
}
