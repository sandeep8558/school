<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\FeeGroup;
use App\Models\Service;
use App\Models\Admission;
use App\Models\Razorpay;
use App\Models\Grade;

class PDFController extends Controller
{
    public function demo(){
        $data = [
            "name" => "Sandeep Rathod"
        ];
        $pdf = Pdf::loadView('pdf.demo', $data);
        return $pdf->stream('invoice.pdf');
        return $pdf->download('invoice.pdf');
    }

    public function fee_group($id){
        $data = [
            'fee_group' => FeeGroup::with('fee_group_grades.grade','fee_group_installments','fee_group_parameters','fee_group_Late_fee', 'academic_year', 'payable_at_admission')->find($id)
        ];
        $pdf = Pdf::loadView('pdf.fee_group', $data);
        return $pdf->stream('FeeGroup'.$id.'.pdf');
    }

    public function service($id){
        $data = [
            'service' => Service::with('service_items.service_item_grades','service_items.service_item_installments', 'academic_year')->find($id)
        ];
        $pdf = Pdf::loadView('pdf.service', $data);
        return $pdf->stream('Service'.$id.'.pdf');
    }

    public function application($id){
        $data = [
            'ap' => Admission::with('admission_photos', 'admission_addresses', 'admission_parents', 'admission_siblings', 'branch', 'grade', 'academic_year', 'first_language', 'second_language', 'third_language')->find($id)
        ];
        $pdf = Pdf::loadView('pdf.application', $data);
        return $pdf->stream('Application'.$id.'.pdf');
    }

    public function receipt($id){
        $data = [
            'receipt' => Razorpay::with('razorpay_data')->find($id)
        ];
        $pdf = Pdf::setPaper('a5', 'landscape')->loadView('pdf.receipt', $data);
        return $pdf->stream('Receipt'.$id.'.pdf');
    }

    public function applications($id, $gid, Request $request){
        $apps = Admission::with('grade', 'first_language', 'second_language', 'third_language')
        ->where('academic_year_id', $id);

        if($gid != 'All'){
            $apps = $apps->where('grade_id', $gid);
        }

        $apps = $apps->get();
        $data = [
            'applications' => $apps,
            'cols' => $request->cols
        ];
        $pdf = Pdf::setPaper('a4', 'landscape')->loadView('pdf.applications', $data);
        return $pdf->stream('Applications'.$id.'.pdf');
    }

    public function merit_list($id, $gid, $status){
        $grade = $gid == 'All' ? 'All Grades' : Grade::find($gid)->name;
        $apps = Admission::with('grade')
        ->where('academic_year_id', $id);

        if($gid != 'All'){
            $apps = $apps->where('grade_id', $gid);
        }

        if($status != 'All'){
            $apps = $apps->where('status', $status);
        }

        $apps = $apps->get();
        $data = [
            'apps' => $apps,
            'grade' => $grade
        ];
        $pdf = Pdf::loadView('pdf.merit_list', $data);
        return $pdf->stream('MeritList'.$id.'.pdf');
    }
}
