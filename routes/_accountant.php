<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['auth','verified', 'acc'])->group(function () {

    Route::get('/dashboard_accountant', function(){
        return Inertia::render('Dashboard');
    });

});