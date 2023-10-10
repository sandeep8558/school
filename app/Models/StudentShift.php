<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentShift extends Model
{
    use HasFactory;

    protected $fillable = [ 'branch_id', 'name', 'from', 'to' ];

    public function student_shift_plans(){
        return $this->hasMany('App\Models\StudentShiftPlan')->orderBy('period_index', 'asc');
    }
}
