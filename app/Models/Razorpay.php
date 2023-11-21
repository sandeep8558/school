<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Razorpay extends Model
{

    use HasFactory;

    protected $fillable = ['user_id','razorpay_payment_id','razorpay_order_id','razorpay_signature','verified','razorpayable_id','razorpayable_type'];

    public function razorpayable()
    {
        return $this->morphTo();
    }

}
