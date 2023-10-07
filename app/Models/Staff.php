<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = ['first_name','middle_name','last_name','email','phone','doj','doe','dob','gender','blood_group','aadhar','pan','employee_code'];

    protected $appends = ['name'];

    public function getNameAttribute(){
        return $this->first_name . ' ' . $this->last_name;
    }
}
