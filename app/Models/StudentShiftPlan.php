<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentShiftPlan extends Model
{
    use HasFactory;

    protected $fillable = [ 'student_shift_id', 'period_index', 'from', 'to', 'slot' ];
}
