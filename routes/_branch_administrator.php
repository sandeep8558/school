<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['auth','verified', 'branchadministrator'])->group(function () {

    Route::get('/dashboard-branch-administrator', function(){
        return Inertia::render('Dashboard');
    });

});