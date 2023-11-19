<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeGroup extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = ['academic_year_id', 'name', 'application_fee', 'admission_fee', 'deposit'];

    public function academic_year(){
        return $this->belongsTo(AcademicYear::class);
    }

    public function fee_group_grades(){
        return $this->hasMany(FeeGroupGrade::class);
    }

    public function fee_group_installments(){
        return $this->hasMany(FeeGroupInstallment::class);
    }

    public function payable_at_admission(){
        return $this->hasMany(FeeGroupInstallment::class)->where('payable_at_admission', 'Yes');
    }

    public function fee_group_parameters(){
        return $this->hasMany(FeeGroupParameter::class);
    }

    public function fee_group_Late_fee(){
        return $this->hasOne(FeeGroupLateFee::class);
    }

    public function branch(){
        return $this->belongsToThrough(Branch::class, AcademicYear::class);
    }
}
