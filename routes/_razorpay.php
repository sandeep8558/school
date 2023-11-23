<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::middleware(['auth','verified'])->group(function () {

    Route::post('/razorpay/order_id', [App\Http\Controllers\RazorpayController::class, 'order_id']);

    Route::post('/razorpay/verify_sign', [App\Http\Controllers\RazorpayController::class, 'verify_sign']);

    Route::post('/razorpay/fetch', [App\Http\Controllers\RazorpayController::class, 'fetch']);

});