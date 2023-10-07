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
        $staff_shifts = StaffShift::select('id', 'name as text')->get();
        return Inertia::render('Administrator/StaffManager/StaffShiftDuty', compact('staff_shifts'));
    }

    /* Staff Section */
    public function staff_section(){
        $sections = Section::select('id', 'name as text')->get();
        return Inertia::render('Administrator/StaffManager/StaffSection', compact('sections'));
    }
    
    /* Staff Grade */
    public function staff_grade(){
        $grades = Grade::select('id', 'name as text')->get();
        return Inertia::render('Administrator/StaffManager/StaffGrade', compact('grades'));
    }
    
    /* Staff Subject */
    public function staff_subject(){
        $subjects = Subject::select('id', 'name as text')->get();
        return Inertia::render('Administrator/StaffManager/StaffSubject', compact('subjects'));
    }

    /* Template */
    public function temp(){
        return Inertia::render('Administrator/StaffManager/Temp');
    }

}
