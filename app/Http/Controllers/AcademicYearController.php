<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Auth;

use App\Models\AcademicYear;
use App\Models\Grade;
use App\Models\AcademicYearWeekoff;
use App\Models\AcademicYearHalfday;
use App\Models\AcademicYearHoliday;

class AcademicYearController extends Controller
{

    /* Template */
    public function year(){
        return Inertia::render('Administrator/AcademicYear/Year');
    }

    /* Template */
    public function weekoff(){
        $branch_id = Auth::user()->branch_id;
        $academic_years = AcademicYear::where('branch_id', $branch_id)->orderBy('id', 'desc')->get();
        $grades = Grade::whereHas('section', function($q) use($branch_id){
            $q->where('branch_id', $branch_id);
        })->orderBy('grade_index', 'asc')->get();
        $data = session('data');
        return Inertia::render('Administrator/AcademicYear/Weekoff', compact('academic_years','grades','data'));
    }

    /* Template */
    public function holiday(){
        $branch_id = Auth::user()->branch_id;
        $academic_years = AcademicYear::where('branch_id', $branch_id)->orderBy('id', 'desc')->get();
        $grades = Grade::whereHas('section', function($q) use($branch_id){
            $q->where('branch_id', $branch_id);
        })->orderBy('grade_index', 'asc')->get();
        $data = session('data');
        return Inertia::render('Administrator/AcademicYear/Holiday', compact('academic_years','grades','data'));
    }

    /* Template */
    public function halfday(){
        $branch_id = Auth::user()->branch_id;
        $academic_years = AcademicYear::where('branch_id', $branch_id)->orderBy('id', 'desc')->get();
        $grades = Grade::whereHas('section', function($q) use($branch_id){
            $q->where('branch_id', $branch_id);
        })->orderBy('grade_index', 'asc')->get();
        return Inertia::render('Administrator/AcademicYear/Halfday', compact('academic_years','grades'));
    }

    /* Template */
    public function calendar(){
        $branch_id = Auth::user()->branch_id;
        $academic_years = AcademicYear::where('branch_id', $branch_id)->orderBy('id', 'desc')->get();
        return Inertia::render('Administrator/AcademicYear/Calendar', compact('academic_years'));
    }

    /* Template */
    public function temp(){
        return Inertia::render('Administrator/AcademicYear/Temp');
    }


    /* API Calls */

    public function add_remove_weekoff(Request $request){
        if(AcademicYearWeekoff::where('academic_year_id', $request->academic_year_id)->where('grade_id', $request->grade_id)->where('on_date', $request->on_date)->where('note', 'Week Off')->exists()){
            AcademicYearWeekoff::where('academic_year_id', $request->academic_year_id)->where('grade_id', $request->grade_id)->where('on_date', $request->on_date)->where('note', 'Week Off')->delete();
        } else {
            AcademicYearWeekoff::create($request->all());
        }
        return ["message" => "Successful"];
    }

    public function save_weekoff(Request $request){
        $ay = AcademicYear::find($request->id);
        $from = $ay->from;
        $to = $ay->to;

        $response = [];

        /* Retrive Days to fetch */
        $a = $this->getDays($request);
        $days = $a['days'];
        $which = $a['which'];
        $dates = $this->getDates($days, $which, $from, $to);
        $grades = $request->grade;

        if(sizeof($dates) > 0 && sizeof($grades) > 0){

            foreach($grades as $grade){
                foreach($dates as $date){
                    $data = [
                        'academic_year_id' => $request->id,
                        'grade_id' => $grade,
                        'on_date' => $date,
                        'note' => 'Week Off'
                    ];
                    if(AcademicYearWeekoff::where('academic_year_id', $request->id)->where('grade_id', $grade)->where('on_date', $date)->where('note', 'Week Off')->doesntExist()){
                        AcademicYearWeekoff::create($data);
                    }
                }
            }

            $response['message'] = "Successfully save all week offs";

        } else {
            $response['error'] = "Please fill form correctly";
        }

        return back()->with('data', $response);
    }

    public function add_remove_halfday(Request $request){
        if(AcademicYearHalfday::where('academic_year_id', $request->academic_year_id)->where('grade_id', $request->grade_id)->where('on_date', $request->on_date)->where('note', 'Halfday')->exists()){
            AcademicYearHalfday::where('academic_year_id', $request->academic_year_id)->where('grade_id', $request->grade_id)->where('on_date', $request->on_date)->where('note', 'Halfday')->delete();
        } else {
            AcademicYearHalfday::create($request->all());
        }
        return ["message" => "Successful"];
    }

    public function save_halfday(Request $request){
        $ay = AcademicYear::find($request->id);
        $from = $ay->from;
        $to = $ay->to;

        $response = [];

        /* Retrive Days to fetch */
        $a = $this->getDays($request);
        $days = $a['days'];
        $which = $a['which'];
        $dates = $this->getDates($days, $which, $from, $to);
        $grades = $request->grade;

        if(sizeof($dates) > 0 && sizeof($grades) > 0){

            foreach($grades as $grade){
                foreach($dates as $date){
                    $data = [
                        'academic_year_id' => $request->id,
                        'grade_id' => $grade,
                        'on_date' => $date,
                        'note' => 'Week Off'
                    ];
                    if(AcademicYearHalfday::where('academic_year_id', $request->id)->where('grade_id', $grade)->where('on_date', $date)->where('note', 'Halfday')->doesntExist()){
                        AcademicYearHalfday::create($data);
                    }
                }
            }

            $response['message'] = "Successfully saved all halfdays";

        } else {
            $response['error'] = "Please fill form correctly";
        }

        return back()->with('data', $response);
    }

    public function add_remove_holiday(Request $request){
        if(AcademicYearHoliday::where('academic_year_id', $request->academic_year_id)->where('grade_id', $request->grade_id)->where('on_date', $request->on_date)->exists()){
            AcademicYearHoliday::where('academic_year_id', $request->academic_year_id)->where('grade_id', $request->grade_id)->where('on_date', $request->on_date)->delete();
        } else {
            //AcademicYearHoliday::create($request->all());
        }
        return ["message" => "Successful"];
    }

    public function save_holiday(Request $request){
        $ay = AcademicYear::find($request->id);

        $from = $request->from;
        $to = $request->to;

        $response = [];

        /* Retrive Days to fetch */
        $dates = $this->getFromToDates($from, $to);
        $grades = $request->grade;

        $response["dates"] = $dates;
        $response["grades"] = $grades;

        if(sizeof($dates) > 0 && sizeof($grades) > 0 && ($request->note != null || $request->note != '')){

            foreach($grades as $grade){
                foreach($dates as $date){
                    $data = [
                        'academic_year_id' => $request->id,
                        'grade_id' => $grade,
                        'on_date' => $date,
                        'note' => $request->note,
                    ];
                    if(AcademicYearHoliday::where('academic_year_id', $request->id)->where('grade_id', $grade)->where('on_date', $date)->where('note', $request->note)->doesntExist()){
                        AcademicYearHoliday::create($data);
                    }
                }
            }

            $response['message'] = "Successfully saved all halfdays";

        } else {
            $response['error'] = "Please fill form correctly";
        }

        return back()->with('data', $response);
    }

    public function fetch_weekoff($academic_year_id, $grade_id){
        return AcademicYearWeekoff::where('academic_year_id', $academic_year_id)->where('grade_id', $grade_id)->pluck('on_date')->toArray();
    }

    public function fetch_halfday($academic_year_id, $grade_id){
        return AcademicYearHalfday::where('academic_year_id', $academic_year_id)->where('grade_id', $grade_id)->pluck('on_date')->toArray();
    }

    public function fetch_holiday($academic_year_id, $grade_id){
        return AcademicYearHoliday::select(['on_date', 'note'])->where('academic_year_id', $academic_year_id)->where('grade_id', $grade_id)->get();
    }

    protected function getFromToDates($from, $to){
        if(($from != null || $from != '') &&( $to != null || $to != '')){

            $fromdt=date_create($from);
            $todt=date_create($to);
            $dates = [];
            if($todt >= $fromdt){
                $checkDate = $from;
                while(date_create($checkDate) <= $todt){
                    $dates[] = date('Y-m-d', strtotime($checkDate));
                    $checkDate = date('Y-m-d', strtotime($checkDate. ' + 1 day'));
                }
            } else {
                $dates = [];
            }
        } else {
            $dates = [];
        }
        return $dates;
    }

    protected function getDates($days, $which, $from, $to){

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
        foreach($days as $ind => $day){
            $index = $day < $first_day ? 7 - $first_day + $day : $day - $first_day;
            $reqired_days = $which[$ind];
            for($i = 0; $i<=$weeks; $i++){
                $howMany = ($i * 7) + $index;
                if($howMany <= $diff->days){
                    $is = false;
                    $dd = date('d', strtotime($from. ' + '.$howMany.' days'));
                    $which_dd = null;

                    switch($dd){
                        case ($dd <= 7): $which_dd = 1; break;
                        case ($dd > 7 && $dd <= 14): $which_dd = 2; break;
                        case ($dd > 14 && $dd <= 21): $which_dd = 3; break;
                        case ($dd > 21 && $dd <= 28): $which_dd = 4; break;
                        case ($dd > 28): $which_dd = 5; break;
                    }

                    foreach($reqired_days as $ddd){
                        if($which_dd == $ddd){
                            $is = true;
                        }
                    }
                    if($is){
                        $dates[] = date('Y-m-d', strtotime($from. ' + '.$howMany.' days'));
                    }
                }
            }
        }

        return $dates;
    }

    protected function getDays($request){
        $days = [];
        $which = [];
        if($request->monday['is']){ $days[] = 1; $which[] = $this->getWhich($request->monday); }
        if($request->tuesday['is']){ $days[] = 2; $which[] = $this->getWhich($request->tuesday); }
        if($request->wednesday['is']){ $days[] = 3; $which[] = $this->getWhich($request->wednesday); }
        if($request->thursday['is']){ $days[] = 4; $which[] = $this->getWhich($request->thursday); }
        if($request->friday['is']){ $days[] = 5; $which[] = $this->getWhich($request->friday); }
        if($request->saturday['is']){ $days[] = 6; $which[] = $this->getWhich($request->saturday); }
        if($request->sunday['is']){ $days[] = 7; $which[] = $this->getWhich($request->sunday); }
        return ['days' => $days, 'which' => $which];
    }

    protected function getWhich($request){
        $w = [];
        if($request['first']) { $w[] = 1; }
        if($request['second']) { $w[] = 2; }
        if($request['third']) { $w[] = 3; }
        if($request['fourth']) { $w[] = 4; }
        if($request['fifth']) { $w[] = 5; }
        return $w;
    }

}
