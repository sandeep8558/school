<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Branch;
use App\Models\UserRole;
use App\Models\User;
use Auth;

class AdministratorController extends Controller
{
    public function dashboard_administrator(){
        return Inertia::render('Administrator/Dashboard');
    }

    public function user_manager(){
        $branches = Branch::select('id', 'name as text')->get();
        return Inertia::render('Administrator/UserManager', compact('branches'));
    }

    public function user_manager_roles($user_id){
        $user = User::find($user_id);
        $roles = UserRole::select('id', 'role as text')->where('user_id', $user_id)->get();
        return Inertia::render('Administrator/UserManagerRoles', compact('roles', 'user'));
    }

    public function branch_update(Request $request){
        Auth::user()->update(['branch_id' => $request->branch_id]);
        return back();
    }
}
