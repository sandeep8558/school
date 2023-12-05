<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    use HasFactory;

    protected $fillable = ['branch_id','name','from','to','is_admission_closed','is_academic_year_closed'];

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function batches(){
        return $this->hasMany(Batch::class);
    }

    public function academic_year_intakes(){
        return $this->hasMany(AcademicYearIntake::class);
    }

    public function applications(){
        return $this->hasMany(Admission::class);
    }

    public function successful_applications(){
        return $this->hasMany(Admission::class)->has('razorpay')->with('razorpay');
    }

    public function fee_groups(){
        return $this->hasMany(FeeGroup::class);
    }

    public function batch_teachers(){
        return $this->hasManyThrough(BatchTeacher::class, Batch::class);
    }
}
