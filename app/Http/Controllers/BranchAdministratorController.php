<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class BranchAdministratorController extends Controller
{
    public function dashboard_branch_administrator(){
        return Inertia::render('BranchAdministrator/Dashboard');
    }
}
