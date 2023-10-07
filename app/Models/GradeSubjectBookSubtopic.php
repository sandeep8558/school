<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradeSubjectBookSubtopic extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = ['grade_subject_book_topic_id','subtopic_index','subtopic'];    

    public function grade(){
        return $this->belongsToThrough(Grade::class, [GradeSubject::class, GradeSubjectBook::class, GradeSubjectBookTopic::class]);
    }

    public function subject(){
        return $this->belongsToThrough(Subject::class, [GradeSubject::class, GradeSubjectBook::class, GradeSubjectBookTopic::class]);
    }

    public function grade_subject(){
        return $this->belongsToThrough(GradeSubject::class, [GradeSubjectBook::class, GradeSubjectBookTopic::class]);
    }

    public function grade_subject_book(){
        return $this->belongsToThrough(GradeSubjectBook::class, GradeSubjectBookTopic::class);
    }

    public function grade_subject_book_topic(){
        return $this->belongsTo(GradeSubjectBookTopic::class);
    }

}
