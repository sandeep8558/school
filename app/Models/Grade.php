<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    protected $fillable = ['section_id', 'name', 'grade_index', 'lectures_per_day'];

    public function section(){
        return $this->belongsTo('App\Models\Section');
    }

    public function branch(){
        return $this->belongsToThrough(Branch::class, Section::class);
    }

    public function subject_groups(){
        return $this->hasMany(SubjectGroup::class);
    }

    public function subject_in_groups(){
        return $this->hasManyThrough(SubjectInGroup::class, SubjectGroup::class);
    }
}
