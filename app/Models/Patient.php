<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = [
        'alanguage',
        'name',
        'description',
        'content',
        'code',
        'meta_title',
        'meta_description',
        'order',
        'publish',
        'trash',
        'ishome',
        'highlight',
        'created_at',
        'updated_at',
        'userid_created',
        'userid_updated',
        'customerid_created',
        'customerid_updated',
        'quantity',
    ];
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'userid_created');
    }
    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customerid_created');
    }
    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product');
    }
    public function productDetail()
    {
        return $this->hasOne(Product::class, 'id', 'product');
    }

    public function customerDetail()
    {
        return $this->belongsTo(Customer::class, 'customerid_created');
    }

    // Lấy ra tổng số răng đã mua theo sản phẩm và đại lý
    public static function getTotalQtyBought($product_id = 0, $customer_id = 0)
    {
        return self::where(['product' => $product_id, 'customerid_created' => $customer_id, 'trash' => 0])->sum('quantity');
    }

    public static function getTotalQtyUsed($product_id = 0, $customer_id = 0, $patient_id)
    {
        return self::where(['product' => $product_id, 'customerid_created' => $customer_id, 'trash' => 0])->where('id', '!=', $patient_id )->sum('quantity');
    }
}
