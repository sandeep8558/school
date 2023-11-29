<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    protected $fillable = [ 'branch_id', "name", "bg", "txt" ];

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function students(){
        return $this->hasMany(Student::class);
    }

    protected $appends = ['counts'];

    public function getCountsAttribute(){
        $data = [
            'total' => 0,
            'male' => 0,
            'female' => 0,
        ];
        $data['total'] = $this->students()->count();
        $data['male'] = $this->students()->where('gender', 'Male')->count();
        $data['female'] = $this->students()->where('gender', 'Female')->count();
        return $data;
    }

}
