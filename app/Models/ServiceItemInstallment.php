<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceItemInstallment extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = ['service_item_id','name','amount','due_date'];

    public function service_item(){
        return $this->belongsTo(ServiceItem::class);
    }

    public function service(){
        return $this->belongsToThrough(Service::class, ServiceItem::class);
    }
}
