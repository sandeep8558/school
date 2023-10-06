<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['auth','verified','accountant'])->group(function () {

    Route::get('/dashboard-accountant', function(){
        return Inertia::render('Dashboard');
    });

});