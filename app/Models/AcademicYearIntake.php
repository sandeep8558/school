<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicYearIntake extends Model
{
    use HasFactory;

    protected $fillable = ['academic_year_id','grade_id','intake'];

    public function academic_year(){
        return $this->belongsTo(AcademicYear::class);
    }

    public function grade(){
        return $this->belongsTo(Grade::class);
    }
}
