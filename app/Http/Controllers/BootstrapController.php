<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use App\Http\Requests\BranchRequest;
use App\Http\Requests\AccreditationRequest;
use App\Http\Requests\DesignationRequest;

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



    /* API Calls */
    
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
