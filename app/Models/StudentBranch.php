<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentBranch extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = ['student_id','branch_id','from','to'];

    public function working_branch(){
        return $this->belongsTo(Branch::class);
    }

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function branch(){
        return $this->belongsToThrough(Branch::class, Student::class);
    }
}
