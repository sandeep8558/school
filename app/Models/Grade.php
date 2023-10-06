<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = ['section_id', 'name', 'grade_index', 'lectures_per_day'];

    public function section(){
        return $this->belongsTo('App\Models\Section');
    }
}
