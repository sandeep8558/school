<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    protected $fillable = [
        'branch_id',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'phone',
        'doj',
        'doe',
        'dob',
        'gender',
        'blood_group',
        'aadhar',
        'pan',
        'employee_code',
        'religion',
        'cast',
        'subcast',
        'mothertongue',
        'nationality',
        'marital_status',
        'qualification',
        'degree',
    ];

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function Staff_grades(){
        return $this->hasMany(StaffGrade::class);
    }

    public function batch_teachers(){
        return $this->hasMany(BatchTeacher::class);
    }

    public function Staff_subjects(){
        return $this->hasMany(StaffSubject::class);
    }

    public function batch(){
        return $this->hasManyDeep(
            Batch::class,
            [BatchTeacher::class],
            [null, 'id', 'id'],
            [null, 'staff_id', 'batch_id']
        );
    }

    protected $appends = ['name','full_name'];

    public function getNameAttribute(){
        return $this->first_name . " " . $this->last_name;
    }

    public function getFullNameAttribute(){
        return $this->first_name . " " . $this->middle_name . " " . $this->last_name;
    }
}
