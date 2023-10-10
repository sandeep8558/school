<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectRemark extends Model
{
    use HasFactory;

    protected $fillable = ['subject_in_group_id','code','remark'];
}
