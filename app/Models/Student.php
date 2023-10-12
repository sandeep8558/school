<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'house_id',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'phone',
        'doj',
        'doe',
        'dob',
        'birth_place',
        'gender',
        'blood_group',
        'religion',
        'cast',
        'subcast',
        'cast_category',
        'mothertongue',
        'nationality',
        'aadhar',
        'gr_number',
    ];

    public function house(){
        return $this->belongsTo(House::class);
    }

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    protected $appends = ['full_name'];

    public function getFullNameAttribute(){
        return $this->first_name . " " . $this->last_name;
    }
}
