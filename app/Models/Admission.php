<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_language_id',
        'second_language_id',
        'third_language_id',
        'previous_school',
        'board',

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

        'is_single_parent',
        'single_what',
        'is_alumnus',
        'special_need',
        'speaking_hearing',

        'rating_1',
        'rating_2',
        'rating_3',
        'rating_4',
        'rating_5',
        'rating_6',
        'rating_7',
        'rating_8',
        'rating_9',
        'rating_10',
        'rating_11',
        'rating_12',
        'total_rating',
        'status',
    ];

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

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function house(){
        return $this->belongsTo(House::class);
    }

    public function admission_addresses(){
        return $this->hasMany(AdmissionAddress::class);
    }

    public function admission_documents(){
        return $this->hasMany(AdmissionDocument::class);
    }

    public function admission_parents(){
        return $this->hasMany(AdmissionParent::class);
    }

    public function admission_photos(){
        return $this->hasMany(AdmissionPhoto::class);
    }

    public function admission_siblings(){
        return $this->hasMany(AdmissionSibling::class);
    }

    public function razorpay()
    {
        return $this->morphOne(Razorpay::class, 'razorpayable');
    }

}
