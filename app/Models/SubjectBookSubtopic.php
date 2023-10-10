<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectBookSubtopic extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = ['subject_book_topic_id','subtopic_index','subtopic'];

    public function subject(){
        return $this->belongsToThrough(Subject::class, [SubjectInGroup::class, SubjectBook::class, SubjectBookTopic::class]);
    }

    public function subject_book_topic(){
        return $this->belongsTo(SubjectBookTopic::class);
    }

    public function subject_book(){
        return $this->belongsToThrough(SubjectBook::class, SubjectBookTopic::class);
    }

    public function subject_in_group(){
        return $this->belongsToThrough(SubjectInGroup::class, [SubjectBook::class, SubjectBookTopic::class]);
    }

    public function subject_group(){
        return $this->belongsToThrough(SubjectGroup::class, [SubjectInGroup::class, SubjectBook::class, SubjectBookTopic::class]);
    }

    public function grade(){
        return $this->belongsToThrough(Grade::class, [SubjectGroup::class, SubjectInGroup::class, SubjectBook::class, SubjectBookTopic::class]);
    }

    public function section(){
        return $this->belongsToThrough(Section::class, [Grade::class, SubjectGroup::class, SubjectInGroup::class, SubjectBook::class, SubjectBookTopic::class]);
    }

    public function branch(){
        return $this->belongsToThrough(Branch::class, [Section::class, Grade::class, SubjectGroup::class, SubjectInGroup::class, SubjectBook::class, SubjectBookTopic::class]);
    }
}
