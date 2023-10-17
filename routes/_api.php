<?php
use Illuminate\Support\Facades\Route;

Route::middleware(['auth','verified'])->group(function () {

    /* Fetch Grades */
    Route::get('/api_call/fetch/grades', [App\Http\Controllers\APIController::class, 'fetch_grades']);

    /* Fetch Academic Years */
    Route::get('/api_call/fetch/academic_years', [App\Http\Controllers\APIController::class, 'fetch_academic_years']);

});