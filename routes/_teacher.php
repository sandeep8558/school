<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::middleware(['auth','verified','teacher'])->group(function () {

    Route::get('/dashboard-teacher', function(){
        return Inertia::render('Dashboard');
    });

});