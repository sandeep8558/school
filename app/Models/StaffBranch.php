<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffBranch extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = ['staff_id','branch_id','from','to'];

    public function staff(){
        return $this->belongsTo(Staff::class);
    }

    public function working_branch(){
        return $this->belongsTo(Branch::class);
    }

    public function branch(){
        return $this->belongsToThrough(Branch::class, Staff::class);
    }
}
