<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    use HasFactory;

    protected $fillable = [
        'academic_year_id',
        'grade_id',
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

    public function academic_year(){
        return $this->belongsTo(AcademicYear::class);
    }

    public function grade(){
        return $this->belongsTo(Grade::class);
    }

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function house(){
        return $this->belongsTo(House::class);
    }

    public function admission_addresses(){
        return $this->hasMany(AdmissionAddress::class);
    }

    public function admission_documents(){
        return $this->hasMany(AdmissionDocument::class);
    }

    public function admission_parents(){
        return $this->hasMany(AdmissionParent::class);
    }

    public function admission_photos(){
        return $this->hasMany(AdmissionPhoto::class);
    }

}
