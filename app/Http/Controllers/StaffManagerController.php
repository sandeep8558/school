<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Branch;
use App\Models\Designation;
use App\Models\StaffShift;
use App\Models\Section;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\House;
use Auth;

class StaffManagerController extends Controller
{

    /* Staff */
    public function staffs(){
        return Inertia::render('Administrator/StaffManager/Staff');
    }

    /* Staff Photo */
    public function staff_photo(){
        return Inertia::render('Administrator/StaffManager/StaffPhoto');
    }

    /* Staff Address */
    public function staff_address(){
        return Inertia::render('Administrator/StaffManager/StaffAddress');
    }

    /* Staff Documents */
    public function staff_documents(){
        return Inertia::render('Administrator/StaffManager/StaffDocuments');
    }

    /* Staff Branch */
    public function staff_branch(){
        $branches = Branch::select('id', 'name as text')->get();
        return Inertia::render('Administrator/StaffManager/StaffBranch', compact('branches'));
    }

    /* Staff Designation */
    public function staff_designation(){
        $designations = Designation::select('id', 'designation as text')->get();
        return Inertia::render('Administrator/StaffManager/StaffDesignation', compact('designations'));
    }

    /* Staff Shift Duty */
    public function staff_shift_duty(){
        $branch_id = Auth::user()->branch_id;
        $staff_shifts = StaffShift::where('branch_id', $branch_id)->select('id', 'name as text')->get();
        return Inertia::render('Administrator/StaffManager/StaffShiftDuty', compact('staff_shifts'));
    }

    /* Staff Section */
    public function staff_section(){
        $branch_id = Auth::user()->branch_id;
        $sections = Section::where('branch_id', $branch_id)->select('id', 'name as text')->get();
        return Inertia::render('Administrator/StaffManager/StaffSection', compact('sections'));
    }
    
    /* Staff Grade */
    public function staff_grade(){
        $branch_id = Auth::user()->branch_id;
        $grades = Grade::whereHas('section', function($q) use($branch_id){
            $q->where('branch_id', $branch_id);
        })->select('id', 'name as text')->get();
        return Inertia::render('Administrator/StaffManager/StaffGrade', compact('grades'));
    }
    
    /* Staff Subject */
    public function staff_subject(){
        $branch_id = Auth::user()->branch_id;
        $subjects = Subject::where('branch_id', $branch_id)->select('id', 'name as text')->get();
        return Inertia::render('Administrator/StaffManager/StaffSubject', compact('subjects'));
    }

    /* Staff House Page*/
    public function staff_house(){
        $branch_id = Auth::user()->branch_id;
        $houses = House::where('branch_id', $branch_id)->select('id', 'name as text')->get();
        return Inertia::render('Administrator/StaffManager/StaffHouse', compact('houses'));
    }

}
