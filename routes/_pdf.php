<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth','verified','administrator'])->group(function () {

    /* Demo PDF */
    Route::get('/pdf/demo', [App\Http\Controllers\PDFController::class, 'demo']);

    /* Fee Group PDF */
    Route::get('/pdf/fee_group/{id}', [App\Http\Controllers\PDFController::class, 'fee_group']);

});