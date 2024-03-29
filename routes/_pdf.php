<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth','verified'])->group(function () {

    /* Demo PDF */
    Route::get('/pdf/demo', [App\Http\Controllers\PDFController::class, 'demo']);

    /* Fee Group PDF */
    Route::get('/pdf/fee_group/{id}', [App\Http\Controllers\PDFController::class, 'fee_group']);

    /* Service PDF */
    Route::get('/pdf/service/{id}', [App\Http\Controllers\PDFController::class, 'service']);

    /* Application Form PDF */
    Route::get('/pdf/application/{id}', [App\Http\Controllers\PDFController::class, 'application']);

    /* Recipt PDF */
    Route::get('/pdf/receipt/{id}', [App\Http\Controllers\PDFController::class, 'receipt']);

    /* Applications PDF */
    Route::get('/pdf/applications/{id}/{gid}', [App\Http\Controllers\PDFController::class, 'applications']);

    /* Merit List PDF */
    Route::get('/pdf/merit_list/{id}/{gid}/{status}', [App\Http\Controllers\PDFController::class, 'merit_list']);

});