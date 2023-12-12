<?php

namespace App\Http\Controllers;
use App\Http\Controllers\BatchManagerController;

use Illuminate\Http\Request;
use Inertia\Inertia;

use DateTime;
use DB;
use Auth;
use App\Models\AcademicYear;
use App\Models\Grade;
use App\Models\Batch;
use App\Models\AcademicYearWeekoff;
use App\Models\Timetable;

class TimetableController extends Controller
{

    /* Template */
    public function temp(){
        return Inertia::render('Administrator/Timetable/Temp');
    }

    /* Create Timetable */
    public function create_timetable(){

        $branch_id = Auth::user()->branch_id;
        
        $academic_years = AcademicYear::with('batches.grade', 'batches.division')
        ->with('batches.student_shift.student_shift_plans')
        ->with('batches.batch_teachers.staff', 'batches.batch_teachers.subject_in_group.subject')
        ->where('branch_id', $branch_id)
        ->where('is_academic_year_closed', 'No')
        ->orderBy('id', 'desc')
        ->get();
        
        $grades = Grade::with('subject_in_groups.subject')->whereHas('section', function($q) use($branch_id){
            $q->where('branch_id', $branch_id);
        })->orderBy('grade_index', 'asc')->get();

        return Inertia::render('Administrator/Timetable/CreateTimetable', compact('academic_years', 'grades'));
    }

    /* Batch wise timetable */
    public function batch_wise(){
        return Inertia::render('Administrator/Timetable/BatchWise');
    }

    /* Teacher wise timetable */
    public function teacher_wise(){
        return Inertia::render('Administrator/Timetable/TeacherWise');
    }

    public function save_timetable(Request $request){

        /* Fetched all teachers of selected academic year */
        /* Order by maximum lectures in desending order */
        $bmc = new BatchManagerController();
        $teachers = $bmc->fetch_teachers($request);

        /* Fetched all batches for requested academic year which are needed to create timetable */
        $batches = Batch::query();
        $batches->where('academic_year_id', $request->academic_year_id);
        $batches = $batches->get();

        $timetable = Timetable::create([
            'academic_year_id' => $request->academic_year_id,
            'name' => $request->name
        ]);

        /* Insert data without teacher */
        foreach($batches as  $key=>$batch){
            $days = $this->getWorkingDays($batch);
            foreach($batch->student_shift->student_shift_plans as $plan){
                foreach($days as $day){

                    $data = [
                        'batch_id' => $batch->id,
                        'batch_teacher_id' => null,
                        'student_shift_plan_id' => $plan->id,
                        'day' => $day
                    ];

                    if($timetable->timetable_data()->where('batch_id', $batch->id)->where('student_shift_plan_id', $plan->id)->where('day', $day)->exists()){
                        $timetable->timetable_data()->where('batch_id', $batch->id)->where('student_shift_plan_id', $plan->id)->where('day', $day)->update($data);
                    } else {
                        $timetable->timetable_data()->create($data);
                    }

                }
            }
        }

    }

    /* Get grade wise working days */
    protected function getWorkingDays($batch){

        $days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];

        $ay = AcademicYear::find($batch->academic_year_id);

        $off_days = AcademicYearWeekoff::select(
            DB::raw('WEEKDAY(on_date) as day')
        )
        ->where('academic_year_id', $batch->academic_year_id)
        ->where('grade_id', $batch->grade_id)
        ->groupBy('day')
        ->get();

        foreach($off_days as $day){
            $dates = $this->getDates(((int) $day->day + 1), $ay->from, $ay->to);

            $c = AcademicYearWeekoff::
            where('academic_year_id', $batch->academic_year_id)
            ->where('grade_id', $batch->grade_id)
            ->whereIn('on_date', $dates)
            ->count();

            $is = $c < sizeof($dates) ? false : true;
            if($is){
                unset($days[$day->day]);
            }
        }

        return $days;
    }

    protected function getDates($day, $from, $to){

        $fromdt=date_create($from);
        $todt=date_create($to);
        $diff=date_diff($fromdt,$todt);
        $weeks = $diff->days / 7;
        $reminder = $diff->days % 7;
        if($reminder > 0){
            $weeks += 1;
        }

        $first_day = date("N", strtotime($from));

        $dates = [];

        $index = $day < $first_day ? 7 - $first_day + $day : $day - $first_day;
        for($i = 0; $i<=$weeks; $i++){
            $howMany = ($i * 7) + $index;
            if($howMany <= $diff->days){
                $dates[] = date('Y-m-d', strtotime($from. ' + '.$howMany.' days'));
            }
        }

        return $dates;
    }

}
