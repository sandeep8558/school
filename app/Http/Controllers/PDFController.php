<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\FeeGroup;
use App\Models\Service;

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
        return $pdf->stream('invoice.pdf');
    }

    public function service($id){
        $data = [
            'service' => Service::with('service_items.service_item_grades','service_items.service_item_installments', 'academic_year')->find($id)
        ];
        $pdf = Pdf::loadView('pdf.service', $data);
        return $pdf->stream('invoice.pdf');
    }
}
