<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmissionAddress extends Model
{
    use HasFactory;

    protected $fillable = ['admission_id','address','city','pincode','state','country'];

    public function admission(){
        return $this->belongsTo(Admission::class);
    }
}
