<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentSibling extends Model
{
    use HasFactory;

    protected $fillable = ['student_id','gr_number'];

    public function student(){
        return $this->belongsTo(Student::class);
    }
}
