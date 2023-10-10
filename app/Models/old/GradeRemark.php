<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradeRemark extends Model
{
    use HasFactory;

    protected $fillable = ['grade_id','code','remark'];

    public function grade(){
        return $this->belongsTo('App\Models\Grade');
    }
}