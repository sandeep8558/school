<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::middleware(['auth','verified','head'])->group(function () {

    Route::get('/dashboard_head', function(){
        return Inertia::render('Dashboard');
    });

});