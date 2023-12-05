<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = [
        'academic_year_id',
        'grade_id',
        'division_id',
        'student_shift_id',
        'classroom_id',
    ];

    /* Belongs to Relations */

    public function academic_year(){
        return $this->belongsTo(AcademicYear::class);
    }

    public function grade(){
        return $this->belongsTo(Grade::class);
    }

    public function division(){
        return $this->belongsTo(Division::class);
    }

    public function student_shift(){
        return $this->belongsTo(StudentShift::class);
    }

    public function classroom(){
        return $this->belongsTo(Classroom::class);
    }

    /* Has Many Relations */

    public function batch_students(){
        return $this->hasMany(BatchStudent::class);
    }

    public function batch_teachers(){
        return $this->hasMany(BatchTeacher::class);
    }

    public function batch_timetables(){
        return $this->hasMany(BatchTimetable::class);
    }

    public function class_teacher(){
        return $this->hasOne(BatchTeacher::class)->where('role', 'Class teacher');
    }

}
