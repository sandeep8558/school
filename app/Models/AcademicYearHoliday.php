<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicYearHoliday extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = ['academic_year_id','grade_id','on_date','note'];

    public function academic_year(){
        return $this->belongsTo(AcademicYear::class);
    }

    public function branch(){
        return $this->belongsToThrough(Branch::class, AcademicYear::class);
    }
    
}
