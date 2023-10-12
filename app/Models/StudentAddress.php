<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAddress extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = ['student_id','address','city','pincode','state','country'];

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function branch(){
        return $this->belongsToThrough(Branch::class, Student::class);
    }
}
