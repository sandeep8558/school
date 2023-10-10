<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradeSubjectBookTopic extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = ['grade_subject_book_id','topic_index','topic'];

    public function grade_subject_book(){
        return $this->belongsTo('App\Models\GradeSubjectBook');
    }

    public function grade(){
        return $this->belongsToThrough(Grade::class, [GradeSubject::class, GradeSubjectBook::class]);
    }

    public function subject(){
        return $this->belongsToThrough(Subject::class, [GradeSubject::class, GradeSubjectBook::class]);
    }
}
