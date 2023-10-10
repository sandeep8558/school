<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectBookTopic extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = ['subject_book_id','topic_index','topic'];

    public function grade(){
        return $this->belongsToThrough(Grade::class, [SubjectGroup::class, SubjectInGroup::class, SubjectBook::class]);
    }

    public function subject(){
        return $this->belongsToThrough(Subject::class, [SubjectInGroup::class, SubjectBook::class]);
    }

    public function subject_group(){
        return $this->belongsToThrough(SubjectGroup::class, [SubjectInGroup::class, SubjectBook::class]);
    }

    public function subject_in_group(){
        return $this->belongsToThrough(SubjectInGroup::class, SubjectBook::class);
    }

    public function subject_book(){
        return $this->belongsTo(SubjectBook::class);
    }
}
