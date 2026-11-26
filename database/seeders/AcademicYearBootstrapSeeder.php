<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Branch;
use App\Models\AcademicYear;
use App\Models\AcademicYearIntake;
use App\Models\Grade;
use App\Models\FeeGroup;
use App\Models\FeeGroupGrade;
use App\Models\FeeGroupParameter;
use App\Models\FeeGroupInstallment;
use App\Models\FeeGroupLateFee;

class AcademicYearBootstrapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $branch = Branch::first();
        if (!$branch) {
            return;
        }

        // 1. Default Open Academic Year
        $academicYear = AcademicYear::updateOrCreate(
            [
                'branch_id' => $branch->id,
                'name'      => '2026-2027',
            ],
            [
                'from'                    => '2026-06-01',
                'to'                      => '2027-04-30',
                'is_admission_closed'     => 'No',
                'is_academic_year_closed' => 'No',
            ]
        );

        // 2. Seat Intakes for all Grades in the Branch
        $grades = Grade::whereHas('section', function ($q) use ($branch) {
            $q->where('branch_id', $branch->id);
        })->orderBy('grade_index', 'asc')->get();

        foreach ($grades as $grade) {
            AcademicYearIntake::updateOrCreate(
                [
                    'academic_year_id' => $academicYear->id,
                    'grade_id'         => $grade->id,
                ],
                [
                    'intake' => 80,
                ]
            );
        }

        // 3. Default Standard Fee Group for the Academic Year
        $feeGroup = FeeGroup::updateOrCreate(
            [
                'academic_year_id' => $academicYear->id,
                'name'             => 'Standard Academic Fee 2026-27',
            ],
            [
                'application_fee' => 500,
                'admission_fee'   => 15000,
                'deposit'         => 5000,
            ]
        );

        // Late Fee Rule
        FeeGroupLateFee::updateOrCreate(
            ['fee_group_id' => $feeGroup->id],
            ['amount' => 50, 'per' => 'Day']
        );

        // Map Fee Group to all Grades
        foreach ($grades as $grade) {
            FeeGroupGrade::updateOrCreate(
                [
                    'fee_group_id' => $feeGroup->id,
                    'grade_id'     => $grade->id,
                ],
                [
                    'fee_group_id' => $feeGroup->id,
                    'grade_id'     => $grade->id,
                ]
            );
        }

        // Fee Parameters
        $parameters = [
            ['param' => 'Tuition Fee',     'per_year_fee' => 36000, 'per_month_fee' => 3000],
            ['param' => 'Term & Exam Fee', 'per_year_fee' => 6000,  'per_month_fee' => 500],
            ['param' => 'Library & Lab',   'per_year_fee' => 3000,  'per_month_fee' => 250],
            ['param' => 'Sports & Gym',    'per_year_fee' => 3000,  'per_month_fee' => 250],
        ];

        foreach ($parameters as $param) {
            FeeGroupParameter::updateOrCreate(
                [
                    'fee_group_id' => $feeGroup->id,
                    'param'        => $param['param'],
                ],
                $param
            );
        }

        // Fee Installments
        $installments = [
            [
                'ind'                  => 1,
                'name'                 => 'Installment 1 (At Admission)',
                'amount'               => 16000,
                'due_date'             => '2026-06-10',
                'payable_at_admission' => 'Yes',
            ],
            [
                'ind'                  => 2,
                'name'                 => 'Installment 2 (Term 1)',
                'amount'               => 16000,
                'due_date'             => '2026-10-10',
                'payable_at_admission' => 'No',
            ],
            [
                'ind'                  => 3,
                'name'                 => 'Installment 3 (Term 2)',
                'amount'               => 16000,
                'due_date'             => '2027-01-10',
                'payable_at_admission' => 'No',
            ],
        ];

        foreach ($installments as $inst) {
            FeeGroupInstallment::updateOrCreate(
                [
                    'fee_group_id' => $feeGroup->id,
                    'ind'          => $inst['ind'],
                ],
                $inst
            );
        }
    }
}
