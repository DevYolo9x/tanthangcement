<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient_payments extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'publish', 'customer_id', 'userid_created', 'userid_updated', 'created_at', 'updated_at'];

    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'userid_created');
    }

    public function payment_items()
    {
        return $this->hasMany(Patient_payment_items::class, 'payment_id', 'id');
    }
}