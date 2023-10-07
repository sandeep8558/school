<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffShiftDuty extends Model
{
    use HasFactory;

    protected $fillable = ['staff_id','staff_shift_id'];

    public function staff(){
        return $this->belongsTo(Staff::class);
    }

    public function staff_shift(){
        return $this->belongsTo(StaffShift::class);
    }
}
