<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffSection extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = ['staff_id','section_id','from','to'];

    public function staff(){
        return $this->belongsTo(Staff::class);
    }

    public function section(){
        return $this->belongsTo(Section::class);
    }

    public function branch(){
        return $this->belongsToThrough(Branch::class, Staff::class);
    }
}
