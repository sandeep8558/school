<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Branch;
use App\Models\Section;
use App\Models\Division;
use App\Models\Subject;
use App\Models\Grade;
use App\Models\SubjectGroup;
use App\Models\SubjectInGroup;

class GradeBootstrapSeeder extends Seeder
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

        // 1. Divisions
        $divisions = [
            ['name' => 'A', 'strength' => 40],
            ['name' => 'B', 'strength' => 40],
            ['name' => 'C', 'strength' => 40],
            ['name' => 'D', 'strength' => 40],
        ];

        foreach ($divisions as $div) {
            Division::updateOrCreate(
                ['branch_id' => $branchId, 'name' => $div['name']],
                ['strength' => $div['strength']]
            );
        }

        // 2. Subjects
        $subjects = [
            ['name' => 'English',                    'acronym' => 'ENG',  'note' => 'First Language & Literature'],
            ['name' => 'Hindi',                      'acronym' => 'HIN',  'note' => 'Second/Third Language'],
            ['name' => 'Marathi',                    'acronym' => 'MAR',  'note' => 'State Language'],
            ['name' => 'Mathematics',                'acronym' => 'MATH', 'note' => 'Core Mathematics'],
            ['name' => 'Environmental Studies',      'acronym' => 'EVS',  'note' => 'Primary Environmental Studies'],
            ['name' => 'General Science',            'acronym' => 'SCI',  'note' => 'Physics, Chemistry & Biology'],
            ['name' => 'Social Studies',             'acronym' => 'SST',  'note' => 'History, Civics & Geography'],
            ['name' => 'Computer Science',           'acronym' => 'COMP', 'note' => 'Information Technology & Coding'],
            ['name' => 'Art & Craft',                'acronym' => 'ART',  'note' => 'Drawing, Painting & Craft'],
            ['name' => 'Physical Education',         'acronym' => 'PE',   'note' => 'Sports & Physical Fitness'],
            ['name' => 'Value Education',            'acronym' => 'VED',  'note' => 'Moral Science & Life Skills'],
        ];

        $subjectModels = [];
        foreach ($subjects as $sub) {
            $subjectModels[$sub['acronym']] = Subject::updateOrCreate(
                ['branch_id' => $branchId, 'name' => $sub['name']],
                ['acronym' => $sub['acronym'], 'note' => $sub['note']]
            );
        }

        // 3. Sections & Grades
        $sectionsData = [
            'Pre-Primary' => [
                ['name' => 'Nursery', 'grade_index' => 1,  'lectures_per_day' => 5],
                ['name' => 'Jr. KG',  'grade_index' => 2,  'lectures_per_day' => 5],
                ['name' => 'Sr. KG',  'grade_index' => 3,  'lectures_per_day' => 5],
            ],
            'Primary' => [
                ['name' => 'Grade 1', 'grade_index' => 4,  'lectures_per_day' => 8],
                ['name' => 'Grade 2', 'grade_index' => 5,  'lectures_per_day' => 8],
                ['name' => 'Grade 3', 'grade_index' => 6,  'lectures_per_day' => 8],
                ['name' => 'Grade 4', 'grade_index' => 7,  'lectures_per_day' => 8],
                ['name' => 'Grade 5', 'grade_index' => 8,  'lectures_per_day' => 8],
            ],
            'Secondary' => [
                ['name' => 'Grade 6',  'grade_index' => 9,  'lectures_per_day' => 8],
                ['name' => 'Grade 7',  'grade_index' => 10, 'lectures_per_day' => 8],
                ['name' => 'Grade 8',  'grade_index' => 11, 'lectures_per_day' => 8],
                ['name' => 'Grade 9',  'grade_index' => 12, 'lectures_per_day' => 8],
                ['name' => 'Grade 10', 'grade_index' => 13, 'lectures_per_day' => 8],
            ],
        ];

        foreach ($sectionsData as $sectionName => $grades) {
            $section = Section::updateOrCreate(
                ['branch_id' => $branchId, 'name' => $sectionName],
                ['branch_id' => $branchId, 'name' => $sectionName]
            );

            foreach ($grades as $gradeData) {
                $grade = Grade::updateOrCreate(
                    ['section_id' => $section->id, 'name' => $gradeData['name']],
                    [
                        'grade_index'      => $gradeData['grade_index'],
                        'lectures_per_day' => $gradeData['lectures_per_day'],
                    ]
                );

                // Create a default Compulsory Subject Group for each Grade
                $group = SubjectGroup::updateOrCreate(
                    ['grade_id' => $grade->id, 'name' => 'Core Subjects'],
                    ['least' => '1']
                );

                // Map core subjects based on section
                if ($sectionName === 'Pre-Primary') {
                    $gradeSubjects = [
                        ['acronym' => 'ENG',  'lectures_per_week' => 6, 'is_graded' => 'No'],
                        ['acronym' => 'MATH', 'lectures_per_week' => 6, 'is_graded' => 'No'],
                        ['acronym' => 'EVS',  'lectures_per_week' => 4, 'is_graded' => 'No'],
                        ['acronym' => 'ART',  'lectures_per_week' => 4, 'is_graded' => 'Yes'],
                        ['acronym' => 'PE',   'lectures_per_week' => 4, 'is_graded' => 'Yes'],
                    ];
                } elseif ($sectionName === 'Primary') {
                    $gradeSubjects = [
                        ['acronym' => 'ENG',  'lectures_per_week' => 7, 'is_graded' => 'No'],
                        ['acronym' => 'HIN',  'lectures_per_week' => 5, 'is_graded' => 'No'],
                        ['acronym' => 'MAR',  'lectures_per_week' => 5, 'is_graded' => 'No'],
                        ['acronym' => 'MATH', 'lectures_per_week' => 7, 'is_graded' => 'No'],
                        ['acronym' => 'EVS',  'lectures_per_week' => 6, 'is_graded' => 'No'],
                        ['acronym' => 'COMP', 'lectures_per_week' => 3, 'is_graded' => 'Yes'],
                        ['acronym' => 'ART',  'lectures_per_week' => 3, 'is_graded' => 'Yes'],
                        ['acronym' => 'PE',   'lectures_per_week' => 4, 'is_graded' => 'Yes'],
                    ];
                } else {
                    $gradeSubjects = [
                        ['acronym' => 'ENG',  'lectures_per_week' => 6, 'is_graded' => 'No'],
                        ['acronym' => 'HIN',  'lectures_per_week' => 5, 'is_graded' => 'No'],
                        ['acronym' => 'MAR',  'lectures_per_week' => 5, 'is_graded' => 'No'],
                        ['acronym' => 'MATH', 'lectures_per_week' => 7, 'is_graded' => 'No'],
                        ['acronym' => 'SCI',  'lectures_per_week' => 6, 'is_graded' => 'No'],
                        ['acronym' => 'SST',  'lectures_per_week' => 5, 'is_graded' => 'No'],
                        ['acronym' => 'COMP', 'lectures_per_week' => 2, 'is_graded' => 'Yes'],
                        ['acronym' => 'PE',   'lectures_per_week' => 2, 'is_graded' => 'Yes'],
                        ['acronym' => 'VED',  'lectures_per_week' => 2, 'is_graded' => 'Yes'],
                    ];
                }

                foreach ($gradeSubjects as $gs) {
                    $subject = $subjectModels[$gs['acronym']] ?? null;
                    if ($subject) {
                        SubjectInGroup::updateOrCreate(
                            [
                                'subject_group_id' => $group->id,
                                'subject_id'       => $subject->id,
                            ],
                            [
                                'lectures_per_week' => $gs['lectures_per_week'],
                                'is_consecutive'    => 'No',
                                'is_graded'         => $gs['is_graded'],
                                'min_lect_per_day'  => '1',
                                'max_lect_per_day'  => '2',
                            ]
                        );
                    }
                }
            }
        }
    }
}
