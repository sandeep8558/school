<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradeSubject extends Model
{
    use HasFactory;

    protected $fillable = [
        'grade_id',
        'subject_id',
        'lectures_per_week',
        'is_consecutive',
        'is_graded',
    ];

    public function grade(){
        return $this->belongsTo('App\Models\Grade');
    }

    public function subject(){
        return $this->belongsTo('App\Models\Subject');
    }

    protected $appends = ['subject_text'];

    public function getSubjectTextAttribute(){
        $subject = null;
        if($this->subject && $this->grade){
            $subject = $this->subject->name;
            $grade = $this->grade->name;
            return $grade . " - " . $subject;
        }
    }
}
