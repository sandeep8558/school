<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffDesignation extends Model
{
    use HasFactory;

    protected $fillable = ['staff_id','designation_id','from','to'];

    public function staff(){
        return $this->belongsTo(Staff::class);
    }

    public function designation(){
        return $this->belongsTo(Designation::class);
    }
}
