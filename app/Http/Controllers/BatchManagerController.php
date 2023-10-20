<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BatchRequest;

use Inertia\Inertia;
use Auth;

use App\Models\AcademicYear;
use App\Models\Grade;
use App\Models\Division;
use App\Models\Batch;

use App\Models\Classroom;
use App\Models\StudentShift;

class BatchManagerController extends Controller
{
    /* Batches Page */
    public function batches(){
        
        $branch_id = Auth::user()->branch_id;
        $academic_years = AcademicYear::
        with('batches','batches.batch_students','batches.batch_teachers','batches.batch_timetables','batches.classroom','batches.student_shift', 'batches.grade.subject_in_groups.subject')
        ->where('branch_id', $branch_id)->orderBy('id', 'desc')->get();
        $grades = Grade::whereHas('section', function($q) use($branch_id){
            $q->where('branch_id', $branch_id);
        })->orderBy('grade_index', 'asc')->get();
        $divisions = Division::where('branch_id', $branch_id)->orderBy('id', 'asc')->get();
        $classrooms = Classroom::where('branch_id', $branch_id)->orderBy('id', 'asc')->get();
        $student_shifts = StudentShift::where('branch_id', $branch_id)->orderBy('id', 'asc')->get();

        return Inertia::render('Administrator/BatchManager/Batches', compact('academic_years', 'grades', 'divisions', 'classrooms', 'student_shifts'));
    }

    /* Template */
    public function temp(){
        return Inertia::render('Administrator/BatchManager/Temp');
    }

    /* API Calls */
    public function create_batch(BatchRequest $request){
        Batch::create($request->all());
        return back();
    }
}
