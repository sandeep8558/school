<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = ['academic_year_id','name','is_compulsory'];

    public function academic_year(){
        return $this->belongsTo(AcademicYear::class);
    }

    public function branch(){
        return $this->belongsToThrough(Branch::class, AcademicYear::class);
    }

    public function service_items(){
        return $this->hasMany(ServiceItem::class);
    }
}
