<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceItemGrade extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = ['service_item_id','grade_id'];

    public function service_item(){
        return $this->belongsTo(ServiceItem::class);
    }

    public function service(){
        return $this->belongsToThrough(Service::class, ServiceItem::class);
    }

    public function grade(){
        return $this->belongsTo(Grade::class);
    }
}
