<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradeSubjectRemark extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = ['grade_subject_id','code','remark'];

    public function grade_subject(){
        return $this->belongsTo('App\Models\GradeSubject');
    }

    public function grade(){
        return $this->belongsToThrough(Grade::class, GradeSubject::class);
    }

    public function subject(){
        return $this->belongsToThrough(Subject::class, GradeSubject::class);
    }
}
