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
use App\Models\StudentShiftPlan;
use App\Models\Student;
use App\Models\BatchStudent;
use App\Models\House;
use App\Models\Language;
use App\Models\Staff;
use DB;

class BatchManagerController extends Controller
{
    /* Batches Page */
    public function batches(){
        
        $branch_id = Auth::user()->branch_id;
        $academic_years = AcademicYear::
        with('batches','batches.batch_students','batches.batch_teachers.staff','batches.batch_teachers.assistant','batches.classroom','batches.student_shift', 'batches.grade.subject_in_groups.subject.subject_teachers.staff.Staff_grades')
        ->where('branch_id', $branch_id)->orderBy('id', 'desc')->get();
        $grades = Grade::whereHas('section', function($q) use($branch_id){
            $q->where('branch_id', $branch_id);
        })->orderBy('grade_index', 'asc')->get();
        $divisions = Division::where('branch_id', $branch_id)->orderBy('id', 'asc')->get();
        $classrooms = Classroom::where('branch_id', $branch_id)->orderBy('id', 'asc')->get();
        $student_shifts = StudentShift::where('branch_id', $branch_id)->orderBy('id', 'asc')->get();

        return Inertia::render('Administrator/BatchManager/Batches', compact('academic_years', 'grades', 'divisions', 'classrooms', 'student_shifts'));
    }

    public function teachers(){

        $branch_id = Auth::user()->branch_id;
        
        $academic_years = AcademicYear::with('batches.grade', 'batches.division', 'batches.student_shift.student_shift_plans')->where('branch_id', $branch_id)->orderBy('id', 'desc')->get();
        
        $grades = Grade::with('subject_in_groups.subject')->whereHas('section', function($q) use($branch_id){
            $q->where('branch_id', $branch_id);
        })->orderBy('grade_index', 'asc')->get();

        return Inertia::render('Administrator/BatchManager/Teachers', compact('academic_years', 'grades'));

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

    public function timetable(){

        $branch_id = Auth::user()->branch_id;
        
        $academic_years = AcademicYear::with('batches.grade', 'batches.division')
        ->with('batches.student_shift.student_shift_plans', 'batches.batch_timetables.batch_timetable_data')
        ->with('batches.batch_teachers.staff', 'batches.batch_teachers.subject_in_group.subject')
        ->where('branch_id', $branch_id)
        ->orderBy('id', 'desc')
        ->get();
        
        $grades = Grade::with('subject_in_groups.subject')->whereHas('section', function($q) use($branch_id){
            $q->where('branch_id', $branch_id);
        })->orderBy('grade_index', 'asc')->get();

        $student_shifts = StudentShift::with('student_shift_plans')->where('branch_id', $branch_id)->orderBy('id', 'asc')->get();

        return Inertia::render('Administrator/BatchManager/Timetable', compact('academic_years', 'grades', 'student_shifts'));
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

    public function fetch_teachers(Request $request){

        return $staff = Staff::where('doe', null)
        ->leftJoin('batch_teachers', 'staff.id', 'batch_teachers.staff_id')
        ->join('batches', 'batches.id', 'batch_teachers.batch_id')
        ->join('subject_in_groups', 'subject_in_groups.id', 'batch_teachers.subject_in_group_id')
        ->join('subjects', 'subject_in_groups.subject_id', 'subjects.id')
        
        ->with('batch_teachers', function($q) use($request){
            $q->whereHas('batch', function($qq) use($request){
                $qq->where('academic_year_id', $request->academic_year_id);
            })
            ->join('subject_in_groups', 'subject_in_groups.id', 'batch_teachers.subject_in_group_id')
            ->join('subjects', 'subject_in_groups.subject_id', 'subjects.id')
            ->join('batches', 'batches.id', 'batch_teachers.batch_id')
            ->join('grades', 'grades.id', 'batches.grade_id')
            ->join('divisions', 'divisions.id', 'batches.division_id')
            ->select(
                'batch_teachers.*',
                'subjects.name as subject',
                'subject_in_groups.lectures_per_week',
                'subject_in_groups.is_consecutive',
                'subject_in_groups.min_lect_per_day',
                'subject_in_groups.max_lect_per_day',
                'grades.name as grade',
                'divisions.name as div',
            );
        })

        ->where('batches.academic_year_id', $request->academic_year_id)
        ->select(
            'staff.id',
            'staff.first_name',
            'staff.middle_name',
            'staff.last_name',
            DB::raw('IFNULL( SUM( subject_in_groups.lectures_per_week ), 0 ) as total'),
        )
        ->groupBy(
            'staff.id',
            'staff.first_name',
            'staff.middle_name',
            'staff.last_name',
        )
        ->orderBy('total', 'desc')
        ->get();

    }

    /* Creating Timetable */
    public function create_timetable(Request $request){

        /* Fetched all teachers of selected academic year */
        /* Order by maximum lectures in desending order */
        $teachers = $this->fetch_teachers($request);

        /* Fetched all batches for requested academic year which are needed to create timetable */
        $batches = Batch::query();
        $batches->where('academic_year_id', $request->academic_year_id);
        $batches = $batches->get();

        /* Insert data without teacher */
        foreach($batches as  $key=>$batch){
            foreach($batch->student_shift->student_shift_plans as $plan){
                foreach($request->days as $day){
                    if($day['is']){

                        $data = [
                            'batch_teacher_id' => null,
                            'student_shift_plan_id' => $plan->id,
                            'day' => $day['short']
                        ];

                        if($batch->batch_timetables()->where('student_shift_plan_id', $plan->id)->where('day', $day['short'])->exists()){
                            $batch->batch_timetables()->where('student_shift_plan_id', $plan->id)->where('day', $day['short'])->update($data);
                        } else {
                            $batch->batch_timetables()->create($data);
                        }

                    }
                }
            }
        }

        /* Delete if day doesn't true */
        foreach($request->days as $day){
            if(!$day['is']){
                foreach($batches as  $key=>$batch){
                    $batch->batch_timetables()->where('day', $day['short'])->delete();
                }
            }
        }

        /* Only Class Teachers Entry */
        if($request->first_lecture){
            foreach($teachers as $teacher){
                foreach($batches as $batch){
                    if($teacher->id == $batch->class_teacher->staff_id){
                        $lectures_per_week = $batch->class_teacher->subject_in_group->lectures_per_week;
                        $lectures = $this->noOfLecture($batch->id, $batch->class_teacher->id);
                        if($lectures_per_week > $lectures){}

                        return $this->is_teacher($batch->academic_year_id, $teacher->id, 10, 'Mon');

                        return $batch->batch_timetables;
                    }
                }
            }
        }

        /* Response returned */
        return back();
    }

    /* Counting no of lectures of specific subject teacher */
    protected function noOfLecture($batch_id, $batch_teacher_id){
        return Batch::find($batch_id)->batch_timetables()->where('batch_teacher_id', $batch_teacher_id)->count();
    }

    /* Checking whether theacher is already booked for same slot */
    protected function is_teacher($academic_year_id, $staff_id, $student_shift_plan_id, $day){

        /* Get all slots of same time */
        $ssp = StudentShiftPlan::find($student_shift_plan_id);
        $from = $ssp->from;
        $to = $ssp->to;
        $ssp_ids = StudentShiftPlan::where('from', $from)->where('to', $to)->pluck('id')->toArray();

        /* Chech for batch teacher availability */
        return DB::table('batch_timetables')
        ->join('batches', 'batches.id', 'batch_timetables.batch_id')
        ->where('batches.academic_year_id', $academic_year_id)
        ->join('batch_teachers', 'batch_teachers.id', 'batch_timetables.batch_teacher_id')
        ->where('batch_teachers.staff_id', $staff_id)
        ->whereIn('batch_timetables.student_shift_plan_id', $ssp_ids)
        ->where('batch_timetables.day', $day)
        ->exists();

    }

}
