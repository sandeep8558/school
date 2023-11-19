<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeGroupLateFee extends Model
{
    use HasFactory;

    protected $fillable = ['fee_group_id', 'amount', 'per'];

    public function fee_group(){
        return $this->belongsTo(FeeGroup::class);
    }
}
