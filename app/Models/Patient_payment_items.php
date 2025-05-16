<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient_payment_items extends Model
{
    use HasFactory;
    protected $fillable = ['payment_id', 'customer_id', 'quantity', 'product_id', 'data_json'];

    public static function getProductIdByCustomer($customer_id = 0)
    {
        return self::where('customer_id', $customer_id)->groupBy('product_id')->pluck('product_id');
    }

    public static function getTotalQty($product_id = 0, $customer_id = 0)
    {
        return self::where(['product_id' => $product_id, 'customer_id' => $customer_id])->sum('quantity');
    }

    // Lấy tổng số lượng răng theo đơn hàng
    public static function getTotalQtyPayment($payment_id = 0)
    {
        return self::where(['payment_id' => $payment_id])->sum('quantity');
    }

    // Lấy tổng số lượng răng theo đơn hàng và sản phẩm
    public static function getTotalQtyPaymentAndProduct($payment_id = 0, $product_id = 0)
    {
        return self::where(['payment_id' => $payment_id, 'product_id' => $product_id])->sum('quantity');
    }

    // Lấy danh sách đơn hàng theo id đơn hàng => return arrayID Product
    public static function getProductIdByPaymentID($payment_id = 0)
    {
        return self::where('payment_id', $payment_id)->orderBy('id', 'asc')->get()->toArray();
    }

}