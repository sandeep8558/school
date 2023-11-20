<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceItem extends Model
{
    use HasFactory;

    protected $fillable = ['service_id','name','code','description','amount'];

    public function service(){
        return $this->belongsTo(Service::class);
    }

    public function service_item_grades(){
        return $this->hasMany(ServiceItemGrade::class);
    }

    public function service_item_installments(){
        return $this->hasMany(ServiceItemInstallment::class);
    }
}
