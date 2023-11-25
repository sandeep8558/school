<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Auth;

use App\Models\Setting;
use App\Models\Branch;
use App\Models\AcademicYear;

use App\Models\Admission;
use App\Models\FeeGroup;
use App\Models\FeeGroupGrade;
use App\Models\FeeGroupInstallment;


use App\Http\Controllers\RazorpayController;

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
        $branches = Branch::with('open_academic_years.academic_year_intakes.grade', 'first_languages', 'second_languages', 'third_languages')->get();

        $fee = FeeGroupGrade::
        where('ay.is_admission_closed', 'No')
        ->join('fee_groups as fg', 'fg.id', 'fee_group_grades.fee_group_id')
        ->join('academic_years as ay', 'ay.id', 'fg.academic_year_id')
        ->join('branches as bra', 'bra.id', 'ay.branch_id')
        ->select(
            'fee_group_grades.id',
            'fee_group_grades.grade_id',
            'fee_group_grades.fee_group_id',
            'ay.id as academic_year_id',
            'ay.branch_id',
            'fg.application_fee'
        )
        ->get();


        $msg = session('msg');

        return Inertia::render('Student/Admission', compact('isAdmission', 'branches', 'msg', 'fee'));
    }

    public function admission_my_applications(){

        $fee = FeeGroupGrade::
        where('ay.is_admission_closed', 'No')
        ->join('fee_groups as fg', 'fg.id', 'fee_group_grades.fee_group_id')
        ->join('academic_years as ay', 'ay.id', 'fg.academic_year_id')
        ->join('branches as bra', 'bra.id', 'ay.branch_id')

        ->select(
            'fee_group_grades.id',
            'fee_group_grades.grade_id',
            'fee_group_grades.fee_group_id',
            'ay.id as academic_year_id',
            'ay.branch_id',
            'fg.admission_fee',
            'fg.deposit',
        )
        ->get();

        $emis = FeeGroupInstallment::
        where('ay.is_admission_closed', 'No')
        ->where('fee_group_installments.payable_at_admission', 'Yes')
        ->join('fee_groups as fg', 'fg.id', 'fee_group_installments.fee_group_id')
        ->join('fee_group_grades as fgg', 'fgg.fee_group_id', 'fg.id')
        ->join('academic_years as ay', 'ay.id', 'fg.academic_year_id')
        ->join('branches as bra', 'bra.id', 'ay.branch_id')
        ->select(
            'fee_group_installments.*',
            'ay.id as academic_year_id',
            'ay.branch_id',
            'fgg.grade_id',
        )
        ->get();

        $my_applications = Auth::user()->successful_applications()->with('admission_addresses', 'admission_documents', 'admission_parents', 'admission_photos', 'academic_year', 'grade', 'branch')->get();
        return Inertia::render('Student/MyApplications', compact('my_applications', 'fee', 'emis'));
    }

    public function application($id){
        $application = Admission::with('admission_photos', 'admission_addresses', 'admission_parents', 'admission_siblings', 'branch', 'grade', 'academic_year', 'first_language', 'second_language', 'third_language')
        ->with('razorpay.razorpay_data')
        ->find($id);
        return Inertia::render('Student/Application', compact('application'));
    }

    public function save_admission_payment(Request $request){
        $admission = Admission::find($request->admission_id);
        $timestamp = date('Y-m-d H:i:s');
        $admission->update([
            'payment_at' => $timestamp
        ]);
        $r = $admission->razorpay()->create([
            'amount' => $request->amount,
            'razorpay_order_id' => $request->razorpay_order_id,
            'razorpay_payment_id' => $request->razorpay_payment_id,
            'razorpay_signature' => $request->razorpay_signature,
            'verified' => $request->verified,
            'user_id' => $request->user_id,
        ]);
        foreach($request->rdata as $rdata){
            $r->razorpay_data()->create([
                'obligation' => $rdata['key'],
                'amount' => $rdata['val']
            ]);
        }
        return back();
    }

    public function save_application(Request $request){

        $admission = Admission::create($request->admissions);
        $admission->admission_addresses()->create($request->addresses);

        if(($request->admissions['is_single_parent'] == 'No') || ($request->admissions['is_single_parent'] == 'Yes' && $request->admissions['single_what'] == 'Father')){
            $admission->admission_parents()->create($request->father);
        }
        
        if(($request->admissions['is_single_parent'] == 'No') || ($request->admissions['is_single_parent'] == 'Yes' && $request->admissions['single_what'] == 'Mother')){
            $admission->admission_parents()->create($request->mother);
        }

        if($request->guardian['isGuardian']){
            $admission->admission_parents()->create($request->guardian);
        }

        if($request->photo != null){
            $photo = $this->uploadFile($request->file('photo'), 'admission_photos');
            $admission->admission_photos()->create([
                'media' => $photo
            ]);
        }

        if($request->aadhar != null){
            $aadhar = $this->uploadFile($request->file('aadhar'), 'admission_documents');
            $admission->admission_documents()->create([
                'document_name' => 'Aadhar',
                'document' => $aadhar
            ]);
        }

        if($request->birth_certificate != null){
            $birth_certificate = $this->uploadFile($request->file('birth_certificate'), 'admission_documents');
            $admission->admission_documents()->create([
                'document_name' => 'Birth Certificate',
                'document' => $birth_certificate
            ]);
        }

        if(isset($request->siblings)){
            foreach($request->siblings as $sib){
                $admission->admission_siblings()->create($sib);
            }
        }

        $razorpay = $admission->razorpay()->create($request->razorpay);

        $razorpay->razorpay_data()->create([
            "obligation" => "Application Fee",
            "amount" => $request->razorpay['amount']
        ]);

        return back()->with('msg', 'Application submitted successfully');
    }

    public function uploadFile($file, $folder){
        if($file){
            $name = time().'_'.mt_rand(100000,999999).'_'.$file->getClientOriginalName();
            $file->move($folder, $name);
            return "/".$folder."/".$name;
        }
    }
}
