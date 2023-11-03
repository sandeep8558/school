<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmissionDocument extends Model
{
    use HasFactory;

    protected $fillable = ['admission_id','document_name','document'];

    public function admission(){
        return $this->belongsTo(Admission::class);
    }
}
