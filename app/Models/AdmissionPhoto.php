<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmissionPhoto extends Model
{
    use HasFactory;

    protected $fillable = ['admission_id','media'];

    public function admission(){
        return $this->belongsTo(Admission::class);
    }
}
