<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    
    use HasFactory;

    protected $fillable = [
        'academic_year_id',
        'name',
    ];

    public function academic_year(){
        return $this->belongsTo(AcademicYear::class);
    }

    public function timetable_data(){
        return $this->hasMany(TimetableData::class);
    }

}
