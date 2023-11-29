<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BatchRequest;
use App\Http\Requests\BatchTeacherRequest;

use Inertia\Inertia;
use Auth;

use App\Models\AcademicYear;
use App\Models\Grade;
use App\Models\Division;
use App\Models\Batch;
use App\Models\BatchTeacher;

use App\Models\Classroom;
use App\Models\StudentShift;
use App\Models\Student;
use App\Models\BatchStudent;
use App\Models\House;
use App\Models\Language;

class BatchManagerController extends Controller
{
    /* Batches Page */
    public function batches(){
        
        $branch_id = Auth::user()->branch_id;
        $academic_years = AcademicYear::
        with('batches','batches.batch_students','batches.batch_teachers.staff','batches.batch_teachers.assistant','batches.batch_timetables','batches.classroom','batches.student_shift', 'batches.grade.subject_in_groups.subject', 'batches.grade.subject_in_groups.subject.subject_teachers', 'batches.grade.subject_in_groups.subject.subject_teachers.staff')
        ->where('branch_id', $branch_id)->orderBy('id', 'desc')->get();
        $grades = Grade::whereHas('section', function($q) use($branch_id){
            $q->where('branch_id', $branch_id);
        })->orderBy('grade_index', 'asc')->get();
        $divisions = Division::where('branch_id', $branch_id)->orderBy('id', 'asc')->get();
        $classrooms = Classroom::where('branch_id', $branch_id)->orderBy('id', 'asc')->get();
        $student_shifts = StudentShift::where('branch_id', $branch_id)->orderBy('id', 'asc')->get();

        return Inertia::render('Administrator/BatchManager/Batches', compact('academic_years', 'grades', 'divisions', 'classrooms', 'student_shifts'));
    }

    public function student_pool(){
        
        $branch_id = Auth::user()->branch_id;
        
        $academic_years = AcademicYear::with('batches.grade', 'batches.division')->where('branch_id', $branch_id)->orderBy('id', 'desc')->get();
        
        $grades = Grade::whereHas('section', function($q) use($branch_id){
            $q->where('branch_id', $branch_id);
        })->orderBy('grade_index', 'asc')->get();

        $houses = House::where('branch_id', $branch_id)->get();

        $first_languages = Language::where('branch_id', $branch_id)->where('which', 'First Language')->get();
        $second_languages = Language::where('branch_id', $branch_id)->where('which', 'Second Language')->get();
        $third_languages = Language::where('branch_id', $branch_id)->where('which', 'Third Language')->get();

        return Inertia::render('Administrator/BatchManager/StudentPool', compact('academic_years', 'grades', 'houses', 'first_languages', 'second_languages', 'third_languages'));
    }

    /* Template */
    public function temp(){
        return Inertia::render('Administrator/BatchManager/Temp');
    }

    /* API Calls */

    public function students(Request $request){

        $branch_id = Auth::user()->branch_id;

        $students = Student::where('students.branch_id', $branch_id);

        if(isset($request->academic_year_id)){
            $students = $students->where('students.academic_year_id', $request->academic_year_id);
        }

        if(isset($request->grade_id)){
            $students = $students->where('students.grade_id', $request->grade_id);
        }


        $students = $students
        ->leftJoin('batch_students as bs', 'students.id', 'bs.student_id')
        ->leftJoin('batches', 'batches.id', 'bs.batch_id')
        ->leftJoin('grades', 'grades.id', 'batches.grade_id')
        ->leftJoin('divisions', 'divisions.id', 'batches.division_id')
        ->join('languages as fl', 'students.first_language_id', 'fl.id')
        ->join('languages as sl', 'students.second_language_id', 'sl.id')
        ->join('languages as tl', 'students.third_language_id', 'tl.id')
        ->join('houses', 'students.house_id', 'houses.id');



        $students = $students->select(
            'students.id',
            'students.branch_id',
            'students.first_name',
            'students.middle_name',
            'students.last_name',
            'students.gender',
            'students.house_id',
            'students.first_language_id',
            'students.second_language_id',
            'students.third_language_id',
            'fl.language as first_language',
            'sl.language as second_language',
            'tl.language as third_language',
            'bs.batch_id',
            'bs.id as bsid',
            'batches.grade_id as bgid',
            'batches.division_id as bdid',
            'grades.name as grade',
            'divisions.name as div',
            'houses.name as house',
            'houses.bg',
            'houses.txt',

        )->get();

        return $students;

    }

    public function allocate_student(Request $request){
        if($request->dropped_batch_id == null){
            /* Delete Entry */
            $bs = BatchStudent::find($request->batch_student_id);
            $bs->delete();
        } else {
            if($request->batch_student_id == null){
                /* Create Batch Student */
                $bs = BatchStudent::create([
                    'batch_id' => $request->dropped_batch_id,
                    'student_id' => $request->student_id
                ]);
            } else {
                /* Update Batch Student */
                $bs = BatchStudent::find($request->batch_student_id);
                $bs->update([
                    'batch_id' => $request->dropped_batch_id,
                    'student_id' => $request->student_id
                ]);
            }
        }
        return ["message" => "Success"];
    }

    public function create_batch(BatchRequest $request){
        Batch::create($request->all());
        return back();
    }

    public function update_batch(Request $request){
        $batch = Batch::find($request->id);
        $batch->update($request->all());
        return back();
    }

    public function assign_teacher(BatchTeacherRequest $request){
        if(BatchTeacher::where('batch_id', $request->batch_id)->where('subject_in_group_id', $request->subject_in_group_id)->exists()){
            BatchTeacher::where('batch_id', $request->batch_id)->where('subject_in_group_id', $request->subject_in_group_id)->update($request->all());
        } else {
            BatchTeacher::create($request->all());
        }
        return back();
    }
}
