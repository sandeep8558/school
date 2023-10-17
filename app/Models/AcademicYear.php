<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    use HasFactory;

    protected $fillable = ['branch_id','name','from','to','is_admission_closed','is_academic_year_closed'];

    public function branch(){
        return $this->belongsTo(Branch::class);
    }
}
