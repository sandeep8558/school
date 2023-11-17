<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;

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
}
