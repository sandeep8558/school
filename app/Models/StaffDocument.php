<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffDocument extends Model
{
    use HasFactory;

    protected $fillable = ['staff_id','document_name','document'];

    public function staff(){
        return $this->belongsTo(Staff::class);
    }
}
