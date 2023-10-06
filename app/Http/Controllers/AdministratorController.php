<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AdministratorController extends Controller
{
    public function dashboard_administrator(){
        return Inertia::render('Administrator/Dashboard');
    }
}
