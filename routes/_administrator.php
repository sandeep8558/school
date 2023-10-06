<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth','verified','administrator'])->group(function () {

    /* Administrator Dashboard Route */
    Route::get('/dashboard_administrator', [App\Http\Controllers\AdministratorController::class, 'dashboard_administrator']);

    /* Settings Routes */
    Route::get('/settings', [App\Http\Controllers\SettingController::class, 'settings']);
    Route::post('/settings/update', [App\Http\Controllers\SettingController::class, 'settings_update']);

    /* School Bootstrap Pages  */
    Route::get('/school_bootstrap/school_profile', [App\Http\Controllers\BootstrapController::class, 'school_profile']);
    Route::get('/school_bootstrap/designation', [App\Http\Controllers\BootstrapController::class, 'designation']);
    Route::get('/school_bootstrap/classroom', [App\Http\Controllers\BootstrapController::class, 'classroom']);
    Route::get('/school_bootstrap/house', [App\Http\Controllers\BootstrapController::class, 'house']);
    Route::get('/school_bootstrap/staff_shift', [App\Http\Controllers\BootstrapController::class, 'staff_shift']);
    Route::get('/school_bootstrap/student_shift', [App\Http\Controllers\BootstrapController::class, 'student_shift']);

    /* School Bootstrap API calls */
    Route::post('/school_bootstrap/store_branch', [App\Http\Controllers\BootstrapController::class, 'store_branch']);
    Route::post('/school_bootstrap/delete_branch', [App\Http\Controllers\BootstrapController::class, 'delete_branch']);
    Route::post('/school_bootstrap/delete_accreditation', [App\Http\Controllers\BootstrapController::class, 'delete_accreditation']);
    Route::post('/school_bootstrap/save_accreditation', [App\Http\Controllers\BootstrapController::class, 'save_accreditation']);
    Route::post('/school_bootstrap/save_designation', [App\Http\Controllers\BootstrapController::class, 'save_designation']);
    Route::post('/school_bootstrap/delete_designation', [App\Http\Controllers\BootstrapController::class, 'delete_designation']);
    Route::post('/school_bootstrap/save_classroom', [App\Http\Controllers\BootstrapController::class, 'save_classroom']);
    Route::post('/school_bootstrap/delete_classroom', [App\Http\Controllers\BootstrapController::class, 'delete_classroom']);
    Route::post('/school_bootstrap/save_house', [App\Http\Controllers\BootstrapController::class, 'save_house']);
    Route::post('/school_bootstrap/delete_house', [App\Http\Controllers\BootstrapController::class, 'delete_house']);
    Route::post('/school_bootstrap/save_staff_shift', [App\Http\Controllers\BootstrapController::class, 'save_staff_shift']);
    Route::post('/school_bootstrap/delete_staff_shift', [App\Http\Controllers\BootstrapController::class, 'delete_staff_shift']);
    Route::post('/school_bootstrap/save_student_shift', [App\Http\Controllers\BootstrapController::class, 'save_student_shift']);
    Route::post('/school_bootstrap/delete_student_shift', [App\Http\Controllers\BootstrapController::class, 'delete_student_shift']);
    Route::post('/school_bootstrap/save_student_shift_plan', [App\Http\Controllers\BootstrapController::class, 'save_student_shift_plan']);
    Route::post('/school_bootstrap/delete_student_shift_plan', [App\Http\Controllers\BootstrapController::class, 'delete_student_shift_plan']);

    /* Grade Manager Pages */
    Route::get('/grade_manager/sections', [App\Http\Controllers\GradeManagerController::class, 'sections']);
    Route::get('/grade_manager/subjects', [App\Http\Controllers\GradeManagerController::class, 'subjects']);
    Route::get('/grade_manager/grades', [App\Http\Controllers\GradeManagerController::class, 'grades']);
    Route::get('/grade_manager/grade_subjects', [App\Http\Controllers\GradeManagerController::class, 'grade_subjects']);
    Route::get('/grade_manager/grade_subject_books', [App\Http\Controllers\GradeManagerController::class, 'grade_subject_books']);
    Route::get('/grade_manager/grade_subject_book_topics', [App\Http\Controllers\GradeManagerController::class, 'grade_subject_book_topics']);
    Route::get('/grade_manager/grade_subject_book_topic_subtopics', [App\Http\Controllers\GradeManagerController::class, 'grade_subject_book_topic_subtopics']);

    /* Grade Manager API Calls */
    Route::get('/grade_manager/fetch/grade_subject/{grade_id}', [App\Http\Controllers\GradeManagerController::class, 'fetch_grade_subject']);
    Route::get('/grade_manager/fetch/grade_subject_book/{grade_subject_id}', [App\Http\Controllers\GradeManagerController::class, 'fetch_grade_subject_book']);
    

});