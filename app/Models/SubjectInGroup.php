<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectInGroup extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = ['subject_group_id','subject_id','lectures_per_week','is_consecutive','is_graded'];

    public function subject_group(){
        return $this->belongsTo(SubjectGroup::class);
    }

    public function subject(){
        return $this->belongsTo(Subject::class);
    }

    public function grade(){
        return $this->belongsToThrough(Grade::class, SubjectGroup::class);
    }
}
