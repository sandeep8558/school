<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
        'email',
        'password',
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


    /* Function to check role Accountant */
    public function isAccountant(){
        $check = $this->whereHas('user_roles', function($q){
            $q->where('role', 'Accountant');
        })->exists();
        return $check;
    }

    /* Function to check role Administrator */
    public function isAdministrator(){
        $check = $this->whereHas('user_roles', function($q){
            $q->where('role', 'Administrator');
        })->exists();
        return $check;
    }

    /* Function to check role Branch Administrator */
    public function isBranchAdministrator(){
        $check = $this->whereHas('user_roles', function($q){
            $q->where('role', 'Branch Administrator');
        })->exists();
        return $check;
    }

    /* Function to check role Head */
    public function isHead(){
        $check = $this->whereHas('user_roles', function($q){
            $q->where('role', 'Head');
        })->exists();
        return $check;
    }

    /* Function to check role Principal */
    public function isPrincipal(){
        $check = $this->whereHas('user_roles', function($q){
            $q->where('role', 'Principal');
        })->exists();
        return $check;
    }

    /* Function to check role Student */
    public function isStudent(){
        $check = $this->whereHas('user_roles', function($q){
            $q->where('role', 'Student');
        })->exists();
        return $check;
    }

    /* Function to check role Teacher */
    public function isTeacher(){
        $check = $this->whereHas('user_roles', function($q){
            $q->where('role', 'Teacher');
        })->exists();
        return $check;
    }

    public function user_roles(){
        return $this->hasMany('App\Models\UserRole');
    }
}
