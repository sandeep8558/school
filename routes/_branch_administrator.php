<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['auth','verified', 'branchadministrator'])->group(function () {

    Route::get('/dashboard_branch_administrator', [App\Http\Controllers\BranchAdministratorController::class, 'dashboard_branch_administrator']);

});