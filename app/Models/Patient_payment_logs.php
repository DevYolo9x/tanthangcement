<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient_payment_logs extends Model
{
    use HasFactory;
    protected $fillable = ['customer_id', 'product_id', 'quantity', 'note', 'created_at'];
}
