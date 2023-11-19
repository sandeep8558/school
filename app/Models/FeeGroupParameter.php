<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeGroupParameter extends Model
{
    use HasFactory;

    protected $fillable = ['fee_group_id', 'param', 'per_year_fee', 'per_month_fee'];

    public function fee_group(){
        return $this->belongsTo(FeeGroup::class);
    }
}
