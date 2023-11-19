<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Models\User;
use App\Models\Setting;

use App\Http\Controllers\CrudController;

use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
}); */

Route::get('/demo', function () {
    return Carbon::create('2023-10-27')->toFormattedDayDateString();
    return "Praise the Lord";
});

Route::get('/', function () {
    // return Inertia::render('Sandeep');
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/crud/index', [CrudController::class, 'index'])->name('crud.index');
    Route::post('/crud/save', [CrudController::class, 'save'])->name('crud.save');
    Route::post('/crud/delete', [CrudController::class, 'delete'])->name('crud.delete');
});




require __DIR__.'/auth.php';

require __DIR__.'/_accountant.php';

require __DIR__.'/_administrator.php';

require __DIR__.'/_branch_administrator.php';

require __DIR__.'/_head.php';

require __DIR__.'/_principal.php';

require __DIR__.'/_student.php';

require __DIR__.'/_teacher.php';

require __DIR__.'/_api.php';

require __DIR__.'/_pdf.php';




/* This route redirects to users Dashboard as per role */
Route::get('/role_splitter', function(){

    $user = User::with('user_roles')->find(Auth::id());

    if($user->user_roles->count() > 0){

        $role = $user->user_roles[0]->role;

        switch($role){
            
            case "Accountant":
            return redirect('/dashboard_accountant');
            break;
            
            case "Administrator":
            return redirect('/dashboard_administrator');
            break;
            
            case "Branch Administrator":
            return redirect('/dashboard_branch_administrator');
            break;
            
            case "Head":
            return redirect('/dashboard_head');
            break;
            
            case "Principal":
            return redirect('/dashboard_principal');
            break;
            
            case "Student":
            return redirect('/dashboard_student');
            break;
            
            case "Teacher":
            return redirect('/dashboard_teacher');
            break;

            default:
            Auth::logout();
            return redirect('/');
        }

    } else {
        Auth::logout();
        return redirect('/');
    }

})->middleware(['auth', 'verified']);


View::composer(['*'], function($view){

        $favicon = Setting::where('key', 'Favicon')->exists() ? Setting::where('key', 'Favicon')->first()->val : null;
        $logo = Setting::where('key', 'Logo')->exists() ? Setting::where('key', 'Logo')->first()->val : null;
        $school_name = Setting::where('key', 'School Name')->exists() ? Setting::where('key', 'School Name')->first()->val : null;
        $tag_line = Setting::where('key', 'Tag Line')->exists() ? Setting::where('key', 'Tag Line')->first()->val : null;

        $address = Setting::where('key', 'Address')->exists() ? Setting::where('key', 'Address')->first()->val : null;
        $city = Setting::where('key', 'City')->exists() ? Setting::where('key', 'City')->first()->val : null;
        $pincode = Setting::where('key', 'Pincode')->exists() ? Setting::where('key', 'Pincode')->first()->val : null;
        $state = Setting::where('key', 'State')->exists() ? Setting::where('key', 'State')->first()->val : null;
        $country = Setting::where('key', 'Country')->exists() ? Setting::where('key', 'Country')->first()->val : null;
        $email_address = Setting::where('key', 'Email Address')->exists() ? Setting::where('key', 'Email Address')->first()->val : null;
        $phone_number = Setting::where('key', 'Phone Number')->exists() ? Setting::where('key', 'Phone Number')->first()->val : null;

        $view->with('favicon', $favicon)
        ->with('logo', $logo)
        ->with('school_name', $school_name)
        ->with('tag_line', $tag_line)
        ->with('address', $address)
        ->with('city', $city)
        ->with('pincode', $pincode)
        ->with('state', $state)
        ->with('country', $country)
        ->with('email_address', $email_address)
        ->with('phone_number', $phone_number);

});