<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'phone',
        'doj',
        'doe',
        'dob',
        'gender',
        'blood_group',
        'aadhar',
        'pan',
        'employee_code',
        'religion',
        'cast',
        'subcast',
        'mothertongue',
        'nationality',
        'marital_status',
        'qualification',
        'degree',
    ];

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    protected $appends = ['full_name'];

    public function getFullNameAttribute(){
        return $this->first_name . " " . $this->last_name;
    }
}
