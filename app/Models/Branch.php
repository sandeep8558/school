<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'city',
        'pincode',
        'state',
        'country',
        'lng',
        'lat',
        'email',
        'phone',
        'curriculum',
    ];

    public function accreditations(){
        return $this->hasMany(Accreditation::class);
    }

    public function academic_years(){
        return $this->hasMany(AcademicYear::class);
    }

    public function open_academic_years(){
        return $this->hasMany(AcademicYear::class)->where('is_admission_closed', 'No');
    }
}
