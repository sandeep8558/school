<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Http\Requests\ClassroomRequest;
use App\Http\Requests\HouseRequest;
use App\Http\Requests\StaffShiftRequest;
use App\Http\Requests\StudentShiftRequest;
use App\Http\Requests\StudentShiftPlanRequest;

use App\Models\Classroom;
use App\Models\House;
use App\Models\StaffShift;
use App\Models\StudentShift;
use App\Models\StudentShiftPlan;


use Auth;

class BranchBootstrapController extends Controller
{

    /* PAGES */
    public function classroom(){
        $branch_id = Auth::user()->branch_id;
        $classrooms = Classroom::where('branch_id', $branch_id)->orderBy('id', 'desc')->get();
        return Inertia::render('Administrator/BranchBootstrap/Classroom', compact('classrooms'));
    }

    public function house(){
        $branch_id = Auth::user()->branch_id;
        $houses = House::where('branch_id', $branch_id)->orderBy('id', 'desc')->get();
        return Inertia::render('Administrator/BranchBootstrap/House', compact('houses'));
    }

    public function staff_shift(){
        $branch_id = Auth::user()->branch_id;
        $staff_shifts = StaffShift::where('branch_id', $branch_id)->orderBy('name', 'asc')->get();
        return Inertia::render('Administrator/BranchBootstrap/StaffShift', compact('staff_shifts'));
    }

    public function student_shift(){
        $branch_id = Auth::user()->branch_id;
        $student_shifts = StudentShift::where('branch_id', $branch_id)->orderBy('name', 'asc')->with('student_shift_plans')->get();
        return Inertia::render('Administrator/BranchBootstrap/StudentShift', compact('student_shifts'));
    }

    /* API Calls */

    /* Save and Update Classroom */
    public function save_classroom(ClassroomRequest $request){
        if($request->id == null){
            Classroom::create($request->validated());
        } else {
            Classroom::find($request->id)->update($request->validated());
        }
        return back();
    }

    /* Delete Classroom */
    public function delete_classroom(Request $request){
        Classroom::find($request->id)->delete();
        return back();
    }

    /* Save and Update House */
    public function save_house(HouseRequest $request){
        if($request->id == null){
            House::create($request->validated());
        } else {
            House::find($request->id)->update($request->validated());
        }
        return back();
    }

    /* Delete House */
    public function delete_house(Request $request){
        House::find($request->id)->delete();
        return back();
    }

    /* Save and Update StaffShift */
    public function save_staff_shift(StaffShiftRequest $request){
        if($request->id == null){
            StaffShift::create($request->validated());
        } else {
            StaffShift::find($request->id)->update($request->validated());
        }
        return back();
    }

    /* Delete StaffShift */
    public function delete_staff_shift(Request $request){
        StaffShift::find($request->id)->delete();
        return back();
    }

    /* Save and Update StudentShift */
    public function save_student_shift(StudentShiftRequest $request){
        if($request->id == null){
            StudentShift::create($request->validated());
        } else {
            StudentShift::find($request->id)->update($request->validated());
        }
        return back();
    }

    /* Delete StudentShift */
    public function delete_student_shift(Request $request){
        StudentShift::find($request->id)->delete();
        return back();
    }

    /* Save and Update StudentShiftPlan */
    public function save_student_shift_plan(StudentShiftPlanRequest $request){
        if($request->id == null){
            StudentShiftPlan::create($request->validated());
        } else {
            StudentShiftPlan::find($request->id)->update($request->validated());
        }
        return back();
    }

    /* Delete StudentShiftPlan */
    public function delete_student_shift_plan(Request $request){
        StudentShiftPlan::find($request->id)->delete();
        return back();
    }
}
