<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatchStudent extends Model
{
    use HasFactory;

    protected $fillable = [
        'batch_id',
        'student_id',
        'roll_number',
    ];

    public function batch(){
        return $this->belongsTo(Batch::class);
    }

    public function student(){
        return $this->belongsTo(Student::class);
    }
}
