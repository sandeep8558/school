<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffGrade extends Model
{
    use HasFactory;

    protected $fillable = ['staff_id','grade_id','from','to'];

    public function staff(){
        return $this->belongsTo(Staff::class);
    }

    public function grade(){
        return $this->belongsTo(Grade::class);
    }
}
