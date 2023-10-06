<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use App\Http\Requests\BranchRequest;
use App\Http\Requests\AccreditationRequest;
use App\Http\Requests\DesignationRequest;
use App\Http\Requests\ClassroomRequest;
use App\Http\Requests\HouseRequest;
use App\Http\Requests\StaffShiftRequest;
use App\Http\Requests\StudentShiftRequest;
use App\Http\Requests\StudentShiftPlanRequest;

use Inertia\Inertia;
use App\Models\Setting;
use App\Models\Branch;
use App\Models\Accreditation;
use App\Models\Designation;
use App\Models\Classroom;
use App\Models\House;
use App\Models\StaffShift;
use App\Models\StudentShift;
use App\Models\StudentShiftPlan;

class BootstrapController extends Controller
{

    public function school_profile() {
        $mysettings = Setting::all();
        $data = [
            "address" => $mysettings->where('key', 'Address')->count() > 0 ? $mysettings->where('key', 'Address')->first()->val : null,
            "city" => $mysettings->where('key', 'City')->count() > 0 ? $mysettings->where('key', 'City')->first()->val : null,
            "pincode" => $mysettings->where('key', 'Pincode')->count() > 0 ? $mysettings->where('key', 'Pincode')->first()->val : null,
            "state" => $mysettings->where('key', 'State')->count() > 0 ? $mysettings->where('key', 'State')->first()->val : null,
            "country" => $mysettings->where('key', 'Country')->count() > 0 ? $mysettings->where('key', 'Country')->first()->val : null,
            "email" => $mysettings->where('key', 'Email Address')->count() > 0 ? $mysettings->where('key', 'Email Address')->first()->val : null,
            "phone" => $mysettings->where('key', 'Phone Number')->count() > 0 ? $mysettings->where('key', 'Phone Number')->first()->val : null,
        ];
        $branches = Branch::orderBy('id', 'desc')->with('accreditations')->get(['id','name', 'address', 'city', 'pincode', 'state', 'country', 'lat', 'lng', 'email', 'phone', 'curriculum']);
        return Inertia::render('Administrator/SchoolBootstrap/SchoolProfile', compact('data', 'branches'));
    }

    public function designation(){
        $designations = Designation::orderBy('designation')->get();
        return Inertia::render('Administrator/SchoolBootstrap/Designation', compact('designations'));
    }

    public function classroom(){
        $classrooms = Classroom::orderBy('id', 'desc')->get();
        return Inertia::render('Administrator/SchoolBootstrap/Classroom', compact('classrooms'));
    }

    public function house(){
        $houses = House::orderBy('id', 'desc')->get();
        return Inertia::render('Administrator/SchoolBootstrap/House', compact('houses'));
    }

    public function staff_shift(){
        $staff_shifts = StaffShift::orderBy('name', 'asc')->get();
        return Inertia::render('Administrator/SchoolBootstrap/StaffShift', compact('staff_shifts'));
    }

    public function student_shift(){
        $student_shifts = StudentShift::orderBy('name', 'asc')->with('student_shift_plans')->get();
        return Inertia::render('Administrator/SchoolBootstrap/StudentShift', compact('student_shifts'));
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

    /* Save and Update Designation */
    public function save_designation(DesignationRequest $request){
        if($request->id == null){
            Designation::create($request->validated());
        } else {
            Designation::find($request->id)->update($request->validated());
        }
        return back();
    }

    /* Delete Designation */
    public function delete_designation(Request $request){
        Designation::find($request->id)->delete();
        return back();
    }

    public function store_branch(BranchRequest $request){
        if($request->id == null){
            Branch::create($request->validated());
        } else {
            Branch::find($request->id)->update($request->validated());
        }
        return back();
    }

    public function delete_branch(Request $request){
        Branch::find($request->id)->delete();
        return back();
    }

    public function delete_accreditation(Request $request){
        Accreditation::find($request->id)->delete();
        return back();
    }

    public function save_accreditation(AccreditationRequest $request){

        $input = $request->all();

        /*
        Check is sent data is object or text
        If data is object the uploads file
        */
        if(gettype($request->media) == "object"){
            if($file = $request->file('media')){
                $name = time().'_'.mt_rand(100000,999999).'_'.$file->getClientOriginalName();
                $file->move('accreditation', $name);
                $input["media"] = "/accreditation/".$name;
            }
        }

        if($request->validated()){
            $res = Accreditation::create($input);
        } else {
            $res = Accreditation::create($request->validated());
        }

        return back();
        
    }
}
