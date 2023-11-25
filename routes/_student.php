<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::middleware(['auth','verified','student'])->group(function () {

    Route::get('/dashboard_student', [App\Http\Controllers\StudentController::class, 'dashboard_student']);

    Route::get('/admission', [App\Http\Controllers\StudentController::class, 'admission']);

    Route::get('/admission/my_applications', [App\Http\Controllers\StudentController::class, 'admission_my_applications']);

    Route::get('/admission/my_applications/application/{id}', [App\Http\Controllers\StudentController::class, 'application']);

    Route::post('/admission/save_application', [App\Http\Controllers\StudentController::class, 'save_application']);

    Route::post('/admission/save_admission_payment', [App\Http\Controllers\StudentController::class, 'save_admission_payment']);

});