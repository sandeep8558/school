<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeGroupInstallment extends Model
{
    use HasFactory;

    protected $fillable = ['fee_group_id', 'ind', 'name', 'amount', 'due_date', 'payable_at_admission'];

    public function fee_group(){
        return $this->belongsTo(FeeGroup::class);
    }
}
