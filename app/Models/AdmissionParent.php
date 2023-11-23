<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmissionParent extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = [
        'admission_id',
        'relation',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'phone',
        'dob',
        'pan',
        'aadhar',
        'qualification',
        'degree',
        'occupation',
        'annual_income',
        'company_name',
        'company_address',
    ];

    public function admission(){
        return $this->belongsTo(Admission::class);
    }

    public function branch(){
        return $this->belongsToThrough(Branch::class, Student::class);
    }
}
