<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeGroupGrade extends Model
{
    use HasFactory;

    protected $fillable = ['grade_id', 'fee_group_id'];

    public function fee_group(){
        return $this->belongsTo(FeeGroup::class);
    }

    public function grade(){
        return $this->belongsTo(Grade::class);
    }
}
