<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectBook extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = ['subject_in_group_id','book_title','publication','status'];

    public function subject(){
        return $this->belongsToThrough(Subject::class, SubjectInGroup::class);
    }

    public function subject_in_group(){
        return $this->belongsTo(SubjectInGroup::class);
    }

    public function subject_group(){
        return $this->belongsToThrough(SubjectGroup::class, SubjectInGroup::class);
    }

    public function grade(){
        return $this->belongsToThrough(Grade::class, [SubjectGroup::class, SubjectInGroup::class]);
    }

    public function section(){
        return $this->belongsToThrough(Section::class, [Grade::class, SubjectGroup::class, SubjectInGroup::class]);
    }

    public function branch(){
        return $this->belongsToThrough(Branch::class, [Section::class, Grade::class, SubjectGroup::class, SubjectInGroup::class]);
    }
}
