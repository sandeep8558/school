<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'academic_year_id',
        'grade_id',
        'branch_id',
        'house_id',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'phone',
        'doj',
        'doe',
        'dob',
        'birth_place',
        'gender',
        'blood_group',
        'religion',
        'cast',
        'subcast',
        'cast_category',
        'mothertongue',
        'nationality',
        'aadhar',
        'gr_number',

        'first_language_id',
        'second_language_id',
        'third_language_id',
        'is_single_parent',
        'single_what',
        'is_alumnus',
        'special_need',
        'speaking_hearing',
        'previous_school',
        'board',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'email', 'email');
    }

    public function first_language(){
        return $this->belongsTo(Language::class)->where('which', 'First Language');
    }

    public function second_language(){
        return $this->belongsTo(Language::class)->where('which', 'Second Language');
    }

    public function third_language(){
        return $this->belongsTo(Language::class)->where('which', 'Third Language');
    }

    public function academic_year(){
        return $this->belongsTo(AcademicYear::class);
    }

    public function grade(){
        return $this->belongsTo(Grade::class);
    }

    public function house(){
        return $this->belongsTo(House::class);
    }

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function student_addresses(){
        return $this->hasMany(StudentAddress::class);
    }

    public function student_documents(){
        return $this->hasMany(StudentDocument::class);
    }

    public function student_parents(){
        return $this->hasMany(StudentParent::class);
    }

    public function student_photos(){
        return $this->hasMany(StudentPhoto::class);
    }

    public function student_siblings(){
        return $this->hasMany(StudentSibling::class);
    }

    protected $appends = ['full_name'];

    public function getFullNameAttribute(){
        return $this->first_name . " " . $this->last_name;
    }
}
