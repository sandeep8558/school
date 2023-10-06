<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::middleware(['auth','verified','principal'])->group(function () {

    Route::get('/dashboard-principal', function(){
        return Inertia::render('Dashboard');
    });

});