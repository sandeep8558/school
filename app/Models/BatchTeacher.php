<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatchTeacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'batch_id',
        'subject_in_group_id',
        'staff_id',
        'role',
    ];

    public function batch(){
        return $this->belongsTo(Batch::class);
    }

    public function subject_in_group(){
        return $this->belongsTo(SubjectInGroup::class);
    }

    public function staff(){
        return $this->belongsTo(Staff::class);
    }

}
