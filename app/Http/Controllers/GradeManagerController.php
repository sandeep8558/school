<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Section;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\SubjectGroup;
use App\Models\SubjectInGroup;
use App\Models\SubjectBook;
use App\Models\SubjectBookTopic;
use DB;
use Auth;

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

    /* Division Manager */
    public function division(){
        return Inertia::render('Administrator/GradeManager/Division');
    }

    /* Grades Page */
    public function grades(){
        $branch_id = Auth::user()->branch_id;
        $sections = Section::where('branch_id', $branch_id)->select('id', 'name as text')->get();
        return Inertia::render('Administrator/GradeManager/Grades', compact('sections'));
    }

    /* Subject Group Page */
    public function subject_group(){
        $branch_id = Auth::user()->branch_id;
        $sections = Section::where('branch_id', $branch_id)->select('id', 'name as text')->get();
        return Inertia::render('Administrator/GradeManager/SubjectGroup', compact('sections'));
    }

    /* Grade Subject in Group Page */
    public function subject_in_group(){
        $branch_id = Auth::user()->branch_id;
        $sections = Section::where('branch_id', $branch_id)->select('id', 'name as text')->get();
        $subjects = Subject::select('id', 'name as text')->where('branch_id', $branch_id)->get();
        return Inertia::render('Administrator/GradeManager/SubjectInGroup', compact('sections', 'subjects'));
    }


    /* Grade Subject Books Page */
    public function subject_books(){
        $branch_id = Auth::user()->branch_id;
        $sections = Section::where('branch_id', $branch_id)->select('id', 'name as text')->get();
        return Inertia::render('Administrator/GradeManager/SubjectBooks', compact('sections'));
    }

    /* Book Topics */
    public function subject_book_topic(){
        $branch_id = Auth::user()->branch_id;
        $sections = Section::where('branch_id', $branch_id)->select('id', 'name as text')->get();
        return Inertia::render('Administrator/GradeManager/SubjectBookTopic', compact('sections'));
    }

    /* Book Subtopics */
    public function subject_book_subtopic(){
        $branch_id = Auth::user()->branch_id;
        $sections = Section::where('branch_id', $branch_id)->select('id', 'name as text')->get();
        return Inertia::render('Administrator/GradeManager/SubjectBookSubtopic', compact('sections'));
    }

    /* Grade Remarks */
    public function grade_remark(){
        $branch_id = Auth::user()->branch_id;
        $sections = Section::where('branch_id', $branch_id)->select('id', 'name as text')->get();
        return Inertia::render('Administrator/GradeManager/GradeRemark', compact('sections'));
    }

    /* Grade Subject Remark */
    public function subjects_remark(){
        $branch_id = Auth::user()->branch_id;
        $sections = Section::where('branch_id', $branch_id)->select('id', 'name as text')->get();
        return Inertia::render('Administrator/GradeManager/SubjectRemark', compact('sections'));
    }







    /* API Calls routes are below */

    public function fetch_grade($section_id){
        return Grade::select('id', 'name as text')->where('section_id', $section_id)->get();
    }

    public function fetch_subject_group($grade_id){
        return SubjectGroup::select('id', 'name as text')->where('grade_id', $grade_id)->get();
    }

    public function fetch_subject_in_group($subject_group_id){
        return SubjectInGroup::
        where('subject_group_id', $subject_group_id)
        ->join('subjects', 'subjects.id', 'subject_in_groups.subject_id')
        ->join('subject_groups', 'subject_groups.id', 'subject_in_groups.subject_group_id')
        ->select(DB::raw("CONCAT(subject_groups.name, ' - ', subjects.name) AS text"), 'subject_in_groups.id')
        ->get();
    }

    public function fetch_subject_book($subject_in_group_id){
        return SubjectBook::select('id', 'book_title as text')->where('subject_in_group_id', $subject_in_group_id)->get();
    }

    public function fetch_subject_book_topic($subject_book_id){
        return SubjectBookTopic::select('id', 'topic as text')->where('subject_book_id', $subject_book_id)->get();
    }

}
