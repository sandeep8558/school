<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\RazorpayController;

class Razorpay extends Model
{

    use HasFactory;

    protected $fillable = ['user_id','razorpay_payment_id','razorpay_order_id','razorpay_signature','verified','razorpayable_id','razorpayable_type', 'amount'];

    public function razorpayable()
    {
        return $this->morphTo();
    }

    public function razorpay_data()
    {
        return $this->hasMany(RazorpayData::class);
    }

    /* protected $appends = ['payment'];

    public function getPaymentAttribute(){
        $razor = new RazorpayController();
        //return $this->razorpay_order_id;
        return $razor->fetch($this->razorpay_payment_id);
    } */

}
