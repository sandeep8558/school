<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [ 'branch_id', 'name' ];

    public function grades(){
        return $this->hasMany('App\Models\Grade');
    }
}
