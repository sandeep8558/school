<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use Auth;
use App\Models\House;
use App\Models\Branch;
use App\Models\Grade;
use App\Models\AcademicYear;

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
        return Inertia::render('Administrator/StudentManager/Students', compact('houses', 'academic_years', 'grades'));
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

}
