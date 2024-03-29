<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\AcademicYear;
use App\Models\Grade;
use App\Models\AcademicYearIntake;
use App\Models\Setting;
use Auth;

use App\Models\Admission;
use App\Models\Student;

class AdmissionPoolController extends Controller
{

    public function intake(){
        $branch_id = Auth::user()->branch_id;
        $academic_years = AcademicYear::with('academic_year_intakes')->where('branch_id', $branch_id)->orderBy('id', 'desc')->get();
        $grades = Grade::whereHas('branch', function($q) use($branch_id){
            $q->where('branches.id', $branch_id);
        })->orderBy('grade_index', 'asc')->get();
        return Inertia::render('Administrator/AdmissionPool/Intake', compact('academic_years', 'grades'));
    }

    public function applications(){
        $branch_id = Auth::user()->branch_id;

        $academic_years = AcademicYear::with('academic_year_intakes')->where('branch_id', $branch_id)->where('is_admission_closed', 'No')->orderBy('id', 'desc')->get();

        $grades = Grade::whereHas('branch', function($q) use($branch_id){
            $q->where('branches.id', $branch_id);
        })->orderBy('grade_index', 'asc')->get();

        return Inertia::render('Administrator/AdmissionPool/Applications', compact('academic_years', 'grades'));
    }

    public function applications_admission($admission_id){
        $admission = Admission::with('admission_photos', 'admission_addresses', 'admission_siblings', 'admission_parents', 'admission_documents', 'first_language', 'second_language', 'third_language', 'user.successful_applications', 'branch', 'grade', 'academic_year')->find($admission_id);
        $rating_names = Setting::where('key', 'Like', 'Rating %')->get();
        return Inertia::render('Administrator/AdmissionPool/Admission', compact('admission', 'rating_names'));
    }

    public function rating(){
        $branch_id = Auth::user()->branch_id;
        $academic_years = AcademicYear::with('academic_year_intakes')->where('branch_id', $branch_id)->where('is_admission_closed', 'No')->orderBy('id', 'desc')->get();
        $grades = Grade::whereHas('branch', function($q) use($branch_id){
            $q->where('branches.id', $branch_id);
        })->orderBy('grade_index', 'asc')->get();
        $rating_names = Setting::where('key', 'Like', 'Rating %')->get();

        return Inertia::render('Administrator/AdmissionPool/Rating', compact('academic_years', 'grades', 'rating_names'));
    }

    public function merit_list(){

        $branch_id = Auth::user()->branch_id;
        $academic_years = AcademicYear::with('academic_year_intakes')->where('branch_id', $branch_id)->where('is_admission_closed', 'No')->orderBy('id', 'desc')->get();
        $grades = Grade::whereHas('branch', function($q) use($branch_id){
            $q->where('branches.id', $branch_id);
        })->orderBy('grade_index', 'asc')->get();

        return Inertia::render('Administrator/AdmissionPool/MeritList', compact('academic_years', 'grades'));
    }

    public function update_ratings(Request $request){
        $a = Admission::find($request->id);
        $a->update($request->all());
        return back();
    }

    public function update_admission(Request $request){
        $a = Admission::find($request->id);
        $a->update($request->all());
        return $a;
    }

    public function fetch_applications(Request $request, $academic_year_id){

        $search = $request->search;
        $grade_id = $request->grade_id;
        $ay = AcademicYear::find($academic_year_id);

        $ay = $ay->successful_applications();

        if($search != ''){
            $ay = $ay->where(function($q) use($search) {
                $q->where('id', $search)->orWhere('phone', $search)->orWhere('email', $search);
            });
        }

        if($grade_id != 'All'){
            $ay = $ay->where('grade_id', $grade_id);
        }

        if(isset($request->status)){
            $ay = $ay->where('status', $request->status);
        }

        if(isset($request->order_by)){
            $ay = $ay->orderBy($request->order_by, $request->order);
        }

        $ay = $ay->join('grades', 'admissions.grade_id', 'grades.id')->select('admissions.*', 'grades.name as grade');

        return $ay->with('admission_photos')->get();
    }

    public function save_intake(Request $request){
        $ayi = AcademicYearIntake::where('academic_year_id', $request->academic_year_id)->where('grade_id', $request->grade_id);
        if($ayi->exists()){
            if((int)($request->intake) > 0){
                $ayi->update($request->all());
            } else {
                $ayi->delete();
            }
        } else {
            AcademicYearIntake::create($request->all());
        }
        return back();
    }

    public function migrate_to_students(Request $request){
        $admission = Admission::find($request->id);
        $student = Student::create($admission->toArray());

        $admission->update([
            'student_id' => $student->id
        ]);

        foreach(($admission->admission_addresses()->get()) as $address){
            $student->student_addresses()->create($address->toArray());
        }

        foreach(($admission->admission_documents()->get()) as $doc){
            $student->student_documents()->create($doc->toArray());
        }

        foreach(($admission->admission_parents()->get()) as $parent){
            $student->student_parents()->create($parent->toArray());
        }

        foreach(($admission->admission_photos()->get()) as $photo){
            $student->student_photos()->create($photo->toArray());
        }

        foreach(($admission->admission_siblings()->get()) as $sibling){
            $student->student_siblings()->create($sibling->toArray());
        }
        
        return back();
    }
}
