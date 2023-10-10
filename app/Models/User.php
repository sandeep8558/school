<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Auth;
use App\Models\UserRole;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'mobile',
        'email',
        'password',

        'branch_id',
        'api_token',
        'token_expire_at',
        'otp',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    
    public function user_roles(){
        return $this->hasMany('App\Models\UserRole');
    }

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    protected $appends = ['roles'];

    public function getRolesAttribute(){
        return implode(', ', $this->user_roles()->pluck('role')->toArray());
    }


    /* Function to check role Accountant */
    public function isAccountant(){
        $id = Auth::id();
        $c = UserRole::where('user_id', $id)->where('role', 'Accountant')->count();
        return $c > 0 ? true :false;
    }

    /* Function to check role Administrator */
    public function isAdministrator(){
        $id = Auth::id();
        $c = UserRole::where('user_id', $id)->where('role', 'Administrator')->count();
        return $c > 0 ? true :false;
    }

    /* Function to check role Branch Administrator */
    public function isBranchAdministrator(){
        $id = Auth::id();
        $c = UserRole::where('user_id', $id)->where('role', 'Branch Administrator')->count();
        return $c > 0 ? true :false;
    }

    /* Function to check role Head */
    public function isHead(){
        $id = Auth::id();
        $c = UserRole::where('user_id', $id)->where('role', 'Head')->count();
        return $c > 0 ? true :false;
    }

    /* Function to check role Principal */
    public function isPrincipal(){
        $id = Auth::id();
        $c = UserRole::where('user_id', $id)->where('role', 'Principal')->count();
        return $c > 0 ? true :false;
    }

    /* Function to check role Student */
    public function isStudent(){
        $id = Auth::id();
        $c = UserRole::where('user_id', $id)->where('role', 'Student')->count();
        return $c > 0 ? true :false;
    }

    /* Function to check role Teacher */
    public function isTeacher(){
        $id = Auth::id();
        $c = UserRole::where('user_id', $id)->where('role', 'Teacher')->count();
        return $c > 0 ? true :false;
    }

}
