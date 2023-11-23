<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Http;

class RazorpayController extends Controller
{
    
    protected $api_key = "rzp_test_Hyd3yRA02IKycO";
    protected $api_secret = "iZ4ym0D5KnDZ2eThxtJ7rTDT";

    public function order_id(Request $request){
        $orderData = [
            'receipt'           => 'rcptid_11',
            "currency"          => "INR",
            "payment_capture"   => 1,
            "amount"            => $request->amount,
        ];

        $api = new Api($this->api_key, $this->api_secret);
        $razorpayOrder = $api->order->create($orderData);
        return ['order_id' => $razorpayOrder['id']];

    }

    public function verify_sign(Request $request){
        $response = 0;
        try {
            $api = new Api($this->api_key, $this->api_secret);
            $api->utility->verifyPaymentSignature(array('razorpay_order_id' => $request->razorpay_order_id, 'razorpay_payment_id' => $request->razorpay_payment_id, 'razorpay_signature' => $request->razorpay_signature));
            $response = 1;
        } catch(SignatureVerificationError  $error){
            $response = 0;
        }
        return json_encode(['res' => $response]);
    }

    public function fetch($pid){
        $api = new Api($this->api_key, $this->api_secret);
        return $api->payment->fetch($pid);
    }

}
