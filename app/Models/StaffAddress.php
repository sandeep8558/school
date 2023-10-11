<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffAddress extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = ['staff_id','address','city','pincode','state','country'];

    public function staff(){
        return $this->belongsTo(Staff::class);
    }

    public function branch(){
        return $this->belongsToThrough(Branch::class, Staff::class);
    }
    
}
