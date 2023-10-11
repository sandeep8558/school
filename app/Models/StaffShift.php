<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffShift extends Model
{
    use HasFactory;

    protected $fillable = [ 'branch_id', 'name', 'from', 'to' ];

    public function branch(){
        return $this->hasMany(Branch::class);
    }
}
