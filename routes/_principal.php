<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::middleware(['auth','verified','principal'])->group(function () {

    Route::get('/dashboard_principal', function(){
        return Inertia::render('Dashboard');
    });

});