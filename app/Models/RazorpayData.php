<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RazorpayData extends Model
{
    use HasFactory;

    protected $fillable = ['razorpay_id','obligation','amount'];

    public function razorpay(){
        return $this->belongsTo(Razorpay::class);
    }
}
