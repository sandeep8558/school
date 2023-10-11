<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffSubject extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = ['staff_id','subject_id'];

    public function staff(){
        return $this->belongsTo(Staff::class);
    }

    public function subject(){
        return $this->belongsTo(Subject::class);
    }

    public function branch(){
        return $this->belongsToThrough(Branch::class, Staff::class);
    }
    
}
