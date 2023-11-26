<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use Auth;
use App\Models\House;
use App\Models\Branch;
use App\Models\Grade;
use App\Models\AcademicYear;
use App\Models\Language;
use App\Models\Student;

class StudentManagerController extends Controller
{

    /* Students Page */
    public function students(){
        $branch_id = Auth::user()->branch_id;
        $houses = House::where('branch_id', $branch_id)->select('id', 'name as text')->get();
        $academic_years = AcademicYear::where('branch_id', $branch_id)->select('id', 'name as text')->get();
        $grades = Grade::whereHas('section', function($q) use($branch_id){
            $q->where('branch_id', $branch_id);
        })->select('id', 'name as text')->get();
        $first_languages = Language::where('branch_id', $branch_id)->where('which', 'First Language')->select('id', 'language as text')->get();
        $second_languages = Language::where('branch_id', $branch_id)->where('which', 'Second Language')->select('id', 'language as text')->get();
        $third_languages = Language::where('branch_id', $branch_id)->where('which', 'Third Language')->select('id', 'language as text')->get();

        return Inertia::render('Administrator/StudentManager/Students', compact('houses', 'academic_years', 'grades', 'first_languages', 'second_languages', 'third_languages'));
    }

    /* Student Photo Page */
    public function student_photo(){
        return Inertia::render('Administrator/StudentManager/StudentPhoto');
    }

    /* Student Address Page */
    public function student_address(){
        return Inertia::render('Administrator/StudentManager/StudentAddress');
    }

    /* Student Document Page */
    public function student_document(){
        return Inertia::render('Administrator/StudentManager/StudentDocument');
    }

    /* Student Branch Page */
    public function student_branch(){
        $branches = Branch::select('id', 'name as text')->get();
        return Inertia::render('Administrator/StudentManager/StudentBranch', compact('branches'));
    }

    /* Student Parent Page */
    public function student_parent(){
        return Inertia::render('Administrator/StudentManager/StudentParent');
    }

    /* Student Sibling Page */
    public function student_sibling(){
        return Inertia::render('Administrator/StudentManager/StudentSibling');
    }

    /* Student Houses Page */
    public function student_houses(Request $request){

        /* Preset for options */
        $grade_id = 'All';
        $house_id = 'All';
        $gender = 'All';
        
        /* Branch Fetched */
        $branch_id = Auth::user()->branch_id;
        
        /* Houses fetched */
        $houses = House::where('branch_id', $branch_id)->get();

        /* Grades fetched */
        $grades = Grade::whereHas('section', function($q) use($branch_id){
            $q->where('branch_id', $branch_id);
        })->get();

        $students = Student::with('grade', 'house');

        /* If Grade id sent */
        if(isset($request->grade_id)){
            if($request->grade_id != 'All'){
                $students = $students->where('grade_id', $request->grade_id);
                $grade_id = $request->grade_id;
            }
        }

        /* If House id Sent */
        if(isset($request->house_id)){
            if($request->house_id != 'All'){
                $students = $students->where('house_id', $request->house_id);
                $house_id = $request->house_id;
            }
        }

        /* If gender sent */
        if(isset($request->gender)){
            if($request->gender != 'All'){
                $students = $students->where('gender', $request->gender);
                $gender = $request->gender;
            }
        }

        /* Final students query */
        $students = $students->get();

        return Inertia::render('Administrator/StudentManager/StudentHouses', compact('houses', 'grades', 'students', 'grade_id', 'house_id', 'gender'));

    }

}
