<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Models\Grade;
use App\Models\AcademicYear;

class APIController extends Controller
{

    public function fetch_grades(){
        $branch_id = Auth::user()->branch_id;
        $grades = Grade::whereHas('section', function($q) use($branch_id){
            $q->where('branch_id', $branch_id);
        })->orderBy('grade_index', 'asc')->get();
        return $grades;
    }

    public function fetch_academic_years(){
        $branch_id = Auth::user()->branch_id;
        $academic_years = AcademicYear::where('branch_id', $branch_id)->orderBy('id', 'desc')->get();
        return $academic_years;
    }

}
