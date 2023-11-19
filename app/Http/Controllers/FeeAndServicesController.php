<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Auth;

use App\Models\AcademicYear;
use App\Models\Grade;
use App\Models\FeeGroup;

class FeeAndServicesController extends Controller
{
    
    public function fee(){
        
        $branch_id = Auth::user()->branch_id;
        
        $academic_years = AcademicYear::where('branch_id', $branch_id)->where('is_admission_closed', 'No')->orderBy('id', 'desc')->get();
        
        $grades = Grade::whereHas('branch', function($q) use($branch_id){
            $q->where('branches.id', $branch_id);
        })->orderBy('grade_index', 'asc')->get();

        $all_fee_groups = FeeGroup::whereHas('branch', function($q) use($branch_id){
            $q->where('branches.id', $branch_id);
        })
        ->with('fee_group_grades.grade','fee_group_installments','fee_group_parameters','fee_group_Late_fee', 'academic_year')
        ->orderBy('id', 'desc')
        ->get();

        return Inertia::render('Administrator/FeeAndServices/FeeBootstrap', compact('academic_years', 'grades', 'all_fee_groups'));
    }

    public function services(){
        return Inertia::render('Administrator/FeeAndServices/Services');
    }

    public function save_fee(Request $request){

        if($request->id == null){

            /* Add Fee */

            /* Save Fee Group */
            $fg = FeeGroup::create([
                "academic_year_id" => $request->academic_year_id,
                "name" => $request->name,
                "application_fee" => $request->application_fee,
                "admission_fee" => $request->admission_fee,
                "deposit" => $request->deposit,
            ]);

            /* Save Late Fee */
            $fg->fee_group_Late_fee()->create([
                "amount" => $request->fee_group_late_fee['amount'],
                "per" => $request->fee_group_late_fee['per'],
            ]);

        } else {

            /* Update Fee */

            /* Get Fee Group to update */
            $fg = FeeGroup::find($request->id);

            /* Fee Group Updating */
            $fg->update([
                "academic_year_id" => $request->academic_year_id,
                "name" => $request->name,
                "application_fee" => $request->application_fee,
                "admission_fee" => $request->admission_fee,
                "deposit" => $request->deposit,
            ]);

            /* Late Fee Updating */
            $fg->fee_group_Late_fee()->update([
                "amount" => $request->fee_group_late_fee['amount'],
                "per" => $request->fee_group_late_fee['per'],
            ]);

            /* Grades Deleting */
            $fg->fee_group_grades()->delete();

            /* Fee Parameters Deleting */
            $fg->fee_group_parameters()->delete();

            /* Fee Installments Deleting */
            $fg->fee_group_installments()->delete();

        }


        /* Save Grades */
        foreach($request->fee_group_grades as $grade){
            $fg->fee_group_grades()->create([
                "grade_id" => $grade["grade_id"]
            ]);
        }

        /* Save Parameters */
        foreach($request->fee_group_parameters as $param){
            $fg->fee_group_parameters()->create([
                "param" => $param["param"],
                "per_year_fee" => $param["per_year_fee"],
                "per_month_fee" => $param["per_month_fee"],
            ]);
        }

        /* Save Installmens */
        foreach($request->fee_group_installments as $emi){
            $fg->fee_group_installments()->create([
                "ind" => $emi["ind"],
                "name" => $emi["name"],
                "amount" => $emi["amount"],
                "due_date" => $emi["due_date"],
                "payable_at_admission" => $emi["payable_at_admission"],
            ]);
        }

        return back();
    }

    public function delete_fee(Request $request){

        $fg = FeeGroup::find($request->id);

        $fg->fee_group_grades()->delete();

        $fg->fee_group_parameters()->delete();

        $fg->fee_group_installments()->delete();

        $fg->fee_group_Late_fee()->delete();

        $fg->delete();

        return back();

    }

}
