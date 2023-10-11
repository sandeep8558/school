<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffHouse extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = ['staff_id','house_id','from','to'];

    public function staff(){
        return $this->belongsTo(Staff::class);
    }

    public function house(){
        return $this->belongsTo(House::class);
    }

    public function branch(){
        return $this->belongsToThrough(Branch::class, Staff::class);
    }

}
