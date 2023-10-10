<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::middleware(['auth','verified','student'])->group(function () {

    Route::get('/dashboard_student', function(){
        return Inertia::render('Dashboard');
    });

});