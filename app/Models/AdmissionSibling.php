<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmissionSibling extends Model
{
    use HasFactory;

    protected $fillable = ['admission_id','gr_number'];

    public function admission(){
        return $this->belongsTo(Admission::class);
    }
}