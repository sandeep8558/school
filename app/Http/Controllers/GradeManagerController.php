<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Section;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\GradeSubject;
use App\Models\GradeSubjectBook;
use DB; 

class GradeManagerController extends Controller
{

    /* Subjects Page */
    public function subjects(Request $request){
        return Inertia::render('Administrator/GradeManager/Subjects');
    }

    /* Sections Page */
    public function sections(){
        return Inertia::render('Administrator/GradeManager/Sections');
    }

    /* Grades Page */
    public function grades(){
        $sections = Section::select('id', 'name as text')->get();
        return Inertia::render('Administrator/GradeManager/Grades', compact('sections'));
    }

    /* Grade Subjectt Page */
    public function grade_subjects(){
        $grades = Grade::select('id', 'name as text')->get();
        $subjects = Subject::select('id', 'name as text')->get();
        return Inertia::render('Administrator/GradeManager/GradeSubjects', compact('grades', 'subjects'));
    }

    /* Grade Subject Books Page */
    public function grade_subject_books(){
        $grade_subjects = GradeSubject::
        join('subjects', 'subjects.id', 'grade_subjects.subject_id')
        ->join('grades', 'grades.id', 'grade_subjects.grade_id')
        ->select(DB::raw("CONCAT(grades.name, ' ', subjects.name) AS text"), 'grade_subjects.id')
        ->get();
        return Inertia::render('Administrator/GradeManager/GradeSubjectBooks', compact('grade_subjects'));
    }

    /* Book Topics */
    public function grade_subject_book_topics(){
        $grades = Grade::select('id', 'name as text')->get();
        return Inertia::render('Administrator/GradeManager/GradeSubjectBookTopic', compact('grades'));
    }

    /* Book Subtopics */
    public function grade_subject_book_topic_subtopics(){
        return Inertia::render('Administrator/GradeManager/GradeSubjectBookTopicSubtopic');
    }

    /* Template */
    public function temp(){
        return Inertia::render('Administrator/GradeManager/Temp');
    }

    /* API Calls routes are below */
    public function fetch_grade_subject($grade_id){
        return GradeSubject::
        join('subjects', 'subjects.id', 'grade_subjects.subject_id')
        ->join('grades', 'grades.id', 'grade_subjects.grade_id')
        ->select(DB::raw("CONCAT(grades.name, ' ', subjects.name) AS text"), 'grade_subjects.id')
        ->where('grade_id', $grade_id)
        ->get();
    }

    public function fetch_grade_subject_book($grade_subject_id){
        return GradeSubjectBook::select('id', 'book_title as text')->where('grade_subject_id', $grade_subject_id)->get();
    }

}