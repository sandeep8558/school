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

        /* Branch Fetched */
        $branch_id = Auth::user()->branch_id;

        /* Houses fetched */
        $houses = House::where('branch_id', $branch_id)->select('id', 'name as text')->get();

        /* Academic Year fetched */
        $academic_years = AcademicYear::where('branch_id', $branch_id)->select('id', 'name as text')->get();

        /* Grades fetched */
        $grades = Grade::whereHas('section', function($q) use($branch_id){
            $q->where('branch_id', $branch_id);
        })->select('id', 'name as text')->get();

        /* First Language fetched */
        $first_languages = Language::where('branch_id', $branch_id)->where('which', 'First Language')->select('id', 'language as text')->get();

        /* Second language fetched */
        $second_languages = Language::where('branch_id', $branch_id)->where('which', 'Second Language')->select('id', 'language as text')->get();

        /* Third language fetched */
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

        $s = Student::where('branch_id', $branch_id)->where('house_id', null);
        $non = [
            'total' => $s->count(),
            'male' => $s->where('gender', 'Male')->count(),
            'female' => $s->where('gender', 'Female')->count(),
        ];

        $students = Student::with('grade', 'house')->where('branch_id', $branch_id);

        /* If Grade id sent */
        if(isset($request->grade_id)){
            if($request->grade_id != 'All'){
                $students = $students->where('grade_id', $request->grade_id);
                $grade_id = $request->grade_id;
            }
        }

        /* If House id Sent */
        if(isset($request->house_id)){
            if($request->house_id != 'All' && $request->house_id != 'Uncategorized'){
                $students = $students->where('house_id', $request->house_id);
                $house_id = $request->house_id;
            } else if($request->house_id == 'Uncategorized'){
                $students = $students->where('house_id', null);
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

        return Inertia::render('Administrator/StudentManager/StudentHouses', compact('houses', 'grades', 'students', 'grade_id', 'house_id', 'gender', 'non'));

    }

    /* GRN Allotment Page */
    public function grn_allotment(Request $request){

        /* Variable Setup for querying students data */
        $admission_academic_year_id = isset($request->admission_academic_year_id) ? $request->admission_academic_year_id : 'All';
        $admission_grade_id = isset($request->admission_grade_id) ? $request->admission_grade_id : 'All';

        /* Branch Fetched */
        $branch_id = Auth::user()->branch_id;

        /* Academic Year fetched */
        $academic_years = AcademicYear::where('branch_id', $branch_id)->get();

        /* Grades fetched */
        $grades = Grade::whereHas('section', function($q) use($branch_id){
            $q->where('branch_id', $branch_id);
        })->get();

        /* Students Query Starts Here */
        $students = Student::with('grade', 'academic_year')->where('branch_id', $branch_id);

        /* Academic Year Query */
        if(isset($request->admission_academic_year_id)){
            if($admission_academic_year_id != 'All'){
                $students = $students->where('admission_academic_year_id', $admission_academic_year_id);
            }
        }

        /* Grade Query */
        if(isset($request->admission_grade_id)){
            if($admission_grade_id != 'All'){
                $students = $students->where('admission_grade_id', $admission_grade_id);
            }
        }

        /* Final students query */
        $students = $students->get();

        return Inertia::render('Administrator/StudentManager/GRNAllotment', compact('academic_years', 'grades', 'students', 'admission_academic_year_id', 'admission_grade_id'));
    }

    /* API Call for updating house */
    public function student_house_update(Request $request){
        $i = $request->all();
        $s = Student::find($request->id);
        $i['house_id'] = $request->house_id == 'Uncategorized' ? null : $request->house_id;
        $s->update($i);
        return back();
    }

    public function save_grn(Request $request){

        /* Variable Setup for querying students data */
        $admission_academic_year_id = isset($request->admission_academic_year_id) ? $request->admission_academic_year_id : 'All';
        $admission_grade_id = isset($request->admission_grade_id) ? $request->admission_grade_id : 'All';

        /* Branch Fetched */
        $branch_id = Auth::user()->branch_id;

        /* Students Query Starts Here */
        $students = Student::with('grade', 'academic_year')->where('branch_id', $branch_id);

        /* Academic Year Query */
        if(isset($request->admission_academic_year_id)){
            if($admission_academic_year_id != 'All'){
                $students = $students->where('admission_academic_year_id', $admission_academic_year_id);
            }
        }

        /* Grade Query */
        if(isset($request->admission_grade_id)){
            if($admission_grade_id != 'All'){
                $students = $students->where('admission_grade_id', $admission_grade_id);
            }
        }

        /* Final students query */
        $i = $request->start;
        $students = $students->chunk(100, function($student_chunk) use($request, &$i) {
            $j = $i;
            foreach($student_chunk as $ind=>$student){
                $i = $ind + $j;
                $n = $request->prefix . $request->seperator . $i . $request->seperator . $request->suffix;
                $student->update([
                    'gr_number' => $n
                ]);
            }
            $i+=1;
        });

    }

}
