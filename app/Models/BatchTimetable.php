<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatchTimetable extends Model
{
    use HasFactory;

    protected $fillable = [
        'batch_id',
        'batch_teacher_id',
        'student_shift_plan_id',
    ];

    public function batch(){
        return $this->belongsTo(Batch::class);
    }

    public function batch_teacher(){
        return $this->belongsTo(BatchTeacher::class);
    }

    public function student_shift_plan(){
        return $this->belongsTo(StudentShiftPlan::class);
    }
}
