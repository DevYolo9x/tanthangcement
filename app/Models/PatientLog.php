<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientLog extends Model
{
    use HasFactory;
    protected $fillable = ['patient_id', 'product_id', 'type', 'note', 'customer_id','user_id', 'created_at', 'updated_at'];
    
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }
    
    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
    
    public function patient()
    {
        return $this->hasOne(Patient::class, 'id', 'patient_id');
    }
}
