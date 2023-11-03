<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::middleware(['auth','verified','student'])->group(function () {

    Route::get('/dashboard_student', [App\Http\Controllers\StudentController::class, 'dashboard_student']);

    Route::get('/admission', [App\Http\Controllers\StudentController::class, 'admission']);

});