<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffAddress extends Model
{
    use HasFactory;

    protected $fillable = ['staff_id','address','city','pincode','state','country'];

    public function staff(){
        return $this->belongsTo(Staff::class);
    }
}
