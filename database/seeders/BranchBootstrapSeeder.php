<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Branch;
use App\Models\Classroom;
use App\Models\House;
use App\Models\StaffShift;
use App\Models\StudentShift;
use App\Models\StudentShiftPlan;
use App\Models\Language;

class BranchBootstrapSeeder extends Seeder
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
        $branchId = $branch->id;

        // 1. Classrooms
        $classrooms = [
            ['name' => 'Room 101', 'capacity' => 40],
            ['name' => 'Room 102', 'capacity' => 40],
            ['name' => 'Room 103', 'capacity' => 40],
            ['name' => 'Room 104', 'capacity' => 40],
            ['name' => 'Room 201', 'capacity' => 45],
            ['name' => 'Room 202', 'capacity' => 45],
            ['name' => 'Room 203', 'capacity' => 45],
            ['name' => 'Room 204', 'capacity' => 45],
            ['name' => 'Room 301', 'capacity' => 50],
            ['name' => 'Room 302', 'capacity' => 50],
        ];

        foreach ($classrooms as $room) {
            Classroom::updateOrCreate(
                ['branch_id' => $branchId, 'name' => $room['name']],
                ['capacity' => $room['capacity']]
            );
        }

        // 2. Houses
        $houses = [
            ['name' => 'Red House',    'bg' => '#dc2626', 'txt' => '#ffffff'],
            ['name' => 'Blue House',   'bg' => '#2563eb', 'txt' => '#ffffff'],
            ['name' => 'Green House',  'bg' => '#16a34a', 'txt' => '#ffffff'],
            ['name' => 'Yellow House', 'bg' => '#ca8a04', 'txt' => '#ffffff'],
        ];

        foreach ($houses as $house) {
            House::updateOrCreate(
                ['branch_id' => $branchId, 'name' => $house['name']],
                ['bg' => $house['bg'], 'txt' => $house['txt']]
            );
        }

        // 3. Staff Shifts
        $staffShifts = [
            ['name' => 'Morning Staff Shift', 'from' => '07:00:00', 'to' => '14:30:00'],
            ['name' => 'General Admin Shift', 'from' => '08:30:00', 'to' => '17:00:00'],
        ];

        foreach ($staffShifts as $shift) {
            StaffShift::updateOrCreate(
                ['branch_id' => $branchId, 'name' => $shift['name']],
                ['from' => $shift['from'], 'to' => $shift['to']]
            );
        }

        // 4. Student Shifts & Period Plans
        $morningShift = StudentShift::updateOrCreate(
            ['branch_id' => $branchId, 'name' => 'Morning Shift'],
            ['from' => '07:15:00', 'to' => '13:15:00']
        );

        $plans = [
            ['period_index' => 1,  'from' => '07:15:00', 'to' => '07:30:00', 'slot' => 'Prayer',      'is_in_halfday' => 'Yes'],
            ['period_index' => 2,  'from' => '07:30:00', 'to' => '08:10:00', 'slot' => 'Lecture',     'is_in_halfday' => 'Yes'],
            ['period_index' => 3,  'from' => '08:10:00', 'to' => '08:50:00', 'slot' => 'Lecture',     'is_in_halfday' => 'Yes'],
            ['period_index' => 4,  'from' => '08:50:00', 'to' => '09:05:00', 'slot' => 'Short Break', 'is_in_halfday' => 'Yes'],
            ['period_index' => 5,  'from' => '09:05:00', 'to' => '09:45:00', 'slot' => 'Lecture',     'is_in_halfday' => 'Yes'],
            ['period_index' => 6,  'from' => '09:45:00', 'to' => '10:25:00', 'slot' => 'Lecture',     'is_in_halfday' => 'Yes'],
            ['period_index' => 7,  'from' => '10:25:00', 'to' => '10:55:00', 'slot' => 'Long Break',  'is_in_halfday' => 'No'],
            ['period_index' => 8,  'from' => '10:55:00', 'to' => '11:30:00', 'slot' => 'Lecture',     'is_in_halfday' => 'No'],
            ['period_index' => 9,  'from' => '11:30:00', 'to' => '12:05:00', 'slot' => 'Lecture',     'is_in_halfday' => 'No'],
            ['period_index' => 10, 'from' => '12:05:00', 'to' => '12:40:00', 'slot' => 'Lecture',     'is_in_halfday' => 'No'],
            ['period_index' => 11, 'from' => '12:40:00', 'to' => '13:15:00', 'slot' => 'Lecture',     'is_in_halfday' => 'No'],
        ];

        foreach ($plans as $plan) {
            StudentShiftPlan::updateOrCreate(
                [
                    'student_shift_id' => $morningShift->id,
                    'period_index'     => $plan['period_index'],
                ],
                $plan
            );
        }

        // 5. Languages (First, Second, Third Language)
        $languages = [
            ['language' => 'English',  'acronym' => 'ENG', 'which' => 'First Language',  'is_available' => 'Yes'],
            ['language' => 'Hindi',    'acronym' => 'HIN', 'which' => 'Second Language', 'is_available' => 'Yes'],
            ['language' => 'Marathi',  'acronym' => 'MAR', 'which' => 'Second Language', 'is_available' => 'Yes'],
            ['language' => 'Marathi',  'acronym' => 'MAR', 'which' => 'Third Language',  'is_available' => 'Yes'],
            ['language' => 'Hindi',    'acronym' => 'HIN', 'which' => 'Third Language',  'is_available' => 'Yes'],
            ['language' => 'Sanskrit', 'acronym' => 'SAN', 'which' => 'Third Language',  'is_available' => 'Yes'],
        ];

        foreach ($languages as $lang) {
            Language::updateOrCreate(
                [
                    'branch_id' => $branchId,
                    'language'  => $lang['language'],
                    'which'     => $lang['which'],
                ],
                $lang
            );
        }
    }
}
