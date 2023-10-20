<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectGroup extends Model
{
    
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = ['grade_id','name','least'];

    public function grade(){
        return $this->belongsTo(Grade::class);
    }

    public function section(){
        return $this->belongsToThrough(Section::class, Grade::class);
    }

    public function branch(){
        return $this->belongsToThrough(Branch::class, [Section::class, Grade::class]);
    }

    public function subject_in_groups(){
        return $this->hasMany(SubjectInGroup::class);
    }

    
}
