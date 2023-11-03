<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

use App\Models\Setting;
use App\Models\Branch;
use App\Models\AcademicYear;

class StudentController extends Controller
{
    public function dashboard_student(){
       $admission = Setting::where('key', 'Is Admission Open')->first();
       $isAdmission = $admission ? $admission->val : 'No';

        return Inertia::render('Student/Dashboard', compact('isAdmission'));
    }

    public function admission(){

        /* checked whether admission is open or not and fetched its value */
        $admission = Setting::where('key', 'Is Admission Open')->first();
        $isAdmission = $admission ? $admission->val : 'No';

        /* Fetch branches with academic years and intake data */
        $branches = Branch::with('open_academic_years.academic_year_intakes.grade')->get();

        return Inertia::render('Student/Admission', compact('isAdmission', 'branches'));
    }
}
