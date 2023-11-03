<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\AcademicYear;
use App\Models\Grade;
use App\Models\AcademicYearIntake;

class AdmissionPoolController extends Controller
{
    public function intake(){
        $academic_years = AcademicYear::with('academic_year_intakes')->orderBy('id', 'desc')->get();
        $grades = Grade::orderBy('grade_index', 'asc')->get();
        return Inertia::render('Administrator/AdmissionPool/Intake', compact('academic_years', 'grades'));
    }

    public function save_intake(Request $request){
        $ayi = AcademicYearIntake::where('academic_year_id', $request->academic_year_id)->where('grade_id', $request->grade_id);
        if($ayi->exists()){
            if((int)($request->intake) > 0){
                $ayi->update($request->all());
            } else {
                $ayi->delete();
            }
        } else {
            AcademicYearIntake::create($request->all());
        }
        return back();
    }
}
