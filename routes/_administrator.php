<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth','verified','administrator'])->group(function () {

    /* Administrator Dashboard Route */
    Route::get('/dashboard_administrator', [App\Http\Controllers\AdministratorController::class, 'dashboard_administrator']);

    /* User Manager */
    Route::get('/user_manager', [App\Http\Controllers\AdministratorController::class, 'user_manager']);
    Route::get('/user_manager/roles/{user_id}', [App\Http\Controllers\AdministratorController::class, 'user_manager_roles']);
    Route::post('/user_manager/branch/update', [App\Http\Controllers\AdministratorController::class, 'branch_update']);

    /* Settings Routes */
    Route::get('/settings', [App\Http\Controllers\SettingController::class, 'settings']);
    Route::post('/settings/update', [App\Http\Controllers\SettingController::class, 'settings_update']);

    /* School Bootstrap Pages  */
    Route::get('/school_bootstrap/school_profile', [App\Http\Controllers\BootstrapController::class, 'school_profile']);
    Route::get('/school_bootstrap/designation', [App\Http\Controllers\BootstrapController::class, 'designation']);

    /* School Bootstrap API calls */
    Route::post('/school_bootstrap/store_branch', [App\Http\Controllers\BootstrapController::class, 'store_branch']);
    Route::post('/school_bootstrap/delete_branch', [App\Http\Controllers\BootstrapController::class, 'delete_branch']);
    Route::post('/school_bootstrap/delete_accreditation', [App\Http\Controllers\BootstrapController::class, 'delete_accreditation']);
    Route::post('/school_bootstrap/save_accreditation', [App\Http\Controllers\BootstrapController::class, 'save_accreditation']);
    Route::post('/school_bootstrap/save_designation', [App\Http\Controllers\BootstrapController::class, 'save_designation']);
    Route::post('/school_bootstrap/delete_designation', [App\Http\Controllers\BootstrapController::class, 'delete_designation']);


    /* Branch Bootstrap Pages */
    Route::get('/branch_bootstrap/classroom', [App\Http\Controllers\BranchBootstrapController::class, 'classroom']);
    Route::get('/branch_bootstrap/house', [App\Http\Controllers\BranchBootstrapController::class, 'house']);
    Route::get('/branch_bootstrap/staff_shift', [App\Http\Controllers\BranchBootstrapController::class, 'staff_shift']);
    Route::get('/branch_bootstrap/student_shift', [App\Http\Controllers\BranchBootstrapController::class, 'student_shift']);
    Route::get('/branch_bootstrap/languages', [App\Http\Controllers\BranchBootstrapController::class, 'languages']);


    /* Branch Bootstrap API Calls */
    Route::post('/branch_bootstrap/save_classroom', [App\Http\Controllers\BranchBootstrapController::class, 'save_classroom']);
    Route::post('/branch_bootstrap/delete_classroom', [App\Http\Controllers\BranchBootstrapController::class, 'delete_classroom']);
    Route::post('/branch_bootstrap/save_house', [App\Http\Controllers\BranchBootstrapController::class, 'save_house']);
    Route::post('/branch_bootstrap/delete_house', [App\Http\Controllers\BranchBootstrapController::class, 'delete_house']);
    Route::post('/branch_bootstrap/save_staff_shift', [App\Http\Controllers\BranchBootstrapController::class, 'save_staff_shift']);
    Route::post('/branch_bootstrap/delete_staff_shift', [App\Http\Controllers\BranchBootstrapController::class, 'delete_staff_shift']);
    Route::post('/branch_bootstrap/save_student_shift', [App\Http\Controllers\BranchBootstrapController::class, 'save_student_shift']);
    Route::post('/branch_bootstrap/delete_student_shift', [App\Http\Controllers\BranchBootstrapController::class, 'delete_student_shift']);
    Route::post('/branch_bootstrap/save_student_shift_plan', [App\Http\Controllers\BranchBootstrapController::class, 'save_student_shift_plan']);
    Route::post('/branch_bootstrap/delete_student_shift_plan', [App\Http\Controllers\BranchBootstrapController::class, 'delete_student_shift_plan']);


    /* Grade Manager Pages */
    Route::get('/grade_manager/sections', [App\Http\Controllers\GradeManagerController::class, 'sections']);
    Route::get('/grade_manager/subjects', [App\Http\Controllers\GradeManagerController::class, 'subjects']);
    Route::get('/grade_manager/division', [App\Http\Controllers\GradeManagerController::class, 'division']);
    Route::get('/grade_manager/grades', [App\Http\Controllers\GradeManagerController::class, 'grades']);
    Route::get('/grade_manager/subject_group', [App\Http\Controllers\GradeManagerController::class, 'subject_group']);
    Route::get('/grade_manager/subject_in_group', [App\Http\Controllers\GradeManagerController::class, 'subject_in_group']);
    Route::get('/grade_manager/subject_books', [App\Http\Controllers\GradeManagerController::class, 'subject_books']);
    Route::get('/grade_manager/subject_book_topic', [App\Http\Controllers\GradeManagerController::class, 'subject_book_topic']);
    Route::get('/grade_manager/subject_book_subtopic', [App\Http\Controllers\GradeManagerController::class, 'subject_book_subtopic']);
    Route::get('/grade_manager/grade_remark', [App\Http\Controllers\GradeManagerController::class, 'grade_remark']);
    Route::get('/grade_manager/subjects_remark', [App\Http\Controllers\GradeManagerController::class, 'subjects_remark']);
    

    /* Grade Manager API Calls */
    Route::get('/grade_manager/fetch/grade/{section_id}', [App\Http\Controllers\GradeManagerController::class, 'fetch_grade']);
    Route::get('/grade_manager/fetch/subject_group/{grade_id}', [App\Http\Controllers\GradeManagerController::class, 'fetch_subject_group']);
    Route::get('/grade_manager/fetch/subject_in_group/{subject_group_id}', [App\Http\Controllers\GradeManagerController::class, 'fetch_subject_in_group']);
    Route::get('/grade_manager/fetch/subject_book/{grade_subject_id}', [App\Http\Controllers\GradeManagerController::class, 'fetch_subject_book']);
    Route::get('/grade_manager/fetch/subject_book_topic/{subject_book_id}', [App\Http\Controllers\GradeManagerController::class, 'fetch_subject_book_topic']);


    /* Staff Manager Pages */
    Route::get('/staff_manager/staffs', [App\Http\Controllers\StaffManagerController::class, 'staffs']);
    Route::get('/staff_manager/staff_photo', [App\Http\Controllers\StaffManagerController::class, 'staff_photo']);
    Route::get('/staff_manager/staff_address', [App\Http\Controllers\StaffManagerController::class, 'staff_address']);
    Route::get('/staff_manager/staff_documents', [App\Http\Controllers\StaffManagerController::class, 'staff_documents']);
    Route::get('/staff_manager/staff_branch', [App\Http\Controllers\StaffManagerController::class, 'staff_branch']);
    Route::get('/staff_manager/staff_designation', [App\Http\Controllers\StaffManagerController::class, 'staff_designation']);
    Route::get('/staff_manager/staff_shift_duty', [App\Http\Controllers\StaffManagerController::class, 'staff_shift_duty']);
    Route::get('/staff_manager/staff_section', [App\Http\Controllers\StaffManagerController::class, 'staff_section']);
    Route::get('/staff_manager/staff_grade', [App\Http\Controllers\StaffManagerController::class, 'staff_grade']);
    Route::get('/staff_manager/staff_subject', [App\Http\Controllers\StaffManagerController::class, 'staff_subject']);
    Route::get('/staff_manager/staff_house', [App\Http\Controllers\StaffManagerController::class, 'staff_house']);


    /* Student Manager Pages */
    Route::get('/student_manager/students', [App\Http\Controllers\StudentManagerController::class, 'students']);
    Route::get('/student_manager/student_photo', [App\Http\Controllers\StudentManagerController::class, 'student_photo']);
    Route::get('/student_manager/student_address', [App\Http\Controllers\StudentManagerController::class, 'student_address']);
    Route::get('/student_manager/student_document', [App\Http\Controllers\StudentManagerController::class, 'student_document']);
    Route::get('/student_manager/student_branch', [App\Http\Controllers\StudentManagerController::class, 'student_branch']);
    Route::get('/student_manager/student_parent', [App\Http\Controllers\StudentManagerController::class, 'student_parent']);
    Route::get('/student_manager/student_sibling', [App\Http\Controllers\StudentManagerController::class, 'student_sibling']);
    Route::get('/student_manager/student_houses', [App\Http\Controllers\StudentManagerController::class, 'student_houses']);
    Route::get('/student_manager/grn_allotment', [App\Http\Controllers\StudentManagerController::class, 'grn_allotment']);

    /* Student Manager API Calls */
    Route::post('/student_manager/student_house_update', [App\Http\Controllers\StudentManagerController::class, 'student_house_update']);
    Route::post('/student_manager/save_grn', [App\Http\Controllers\StudentManagerController::class, 'save_grn']);


    /* Academic Year Pages */
    Route::get('/academic_year/year', [App\Http\Controllers\AcademicYearController::class, 'year']);
    Route::get('/academic_year/weekoff', [App\Http\Controllers\AcademicYearController::class, 'weekoff']);
    Route::get('/academic_year/holiday', [App\Http\Controllers\AcademicYearController::class, 'holiday']);
    Route::get('/academic_year/halfday', [App\Http\Controllers\AcademicYearController::class, 'halfday']);
    Route::get('/academic_year/calendar', [App\Http\Controllers\AcademicYearController::class, 'calendar']);

    /* Academic Year API Calls */
    Route::get('/academic_year/fetch/weekoff/{academic_year_id}/{grade_id}', [App\Http\Controllers\AcademicYearController::class, 'fetch_weekoff']);
    Route::get('/academic_year/fetch/halfday/{academic_year_id}/{grade_id}', [App\Http\Controllers\AcademicYearController::class, 'fetch_halfday']);
    Route::get('/academic_year/fetch/holiday/{academic_year_id}/{grade_id}', [App\Http\Controllers\AcademicYearController::class, 'fetch_holiday']);

    Route::post('/academic_year/save_weekoff', [App\Http\Controllers\AcademicYearController::class, 'save_weekoff']);
    Route::post('/academic_year/add_remove_weekoff', [App\Http\Controllers\AcademicYearController::class, 'add_remove_weekoff']);
    Route::post('/academic_year/save_halfday', [App\Http\Controllers\AcademicYearController::class, 'save_halfday']);
    Route::post('/academic_year/add_remove_halfday', [App\Http\Controllers\AcademicYearController::class, 'add_remove_halfday']);
    Route::post('/academic_year/save_holiday', [App\Http\Controllers\AcademicYearController::class, 'save_holiday']);
    Route::post('/academic_year/add_remove_holiday', [App\Http\Controllers\AcademicYearController::class, 'add_remove_holiday']);


    /* Admission Pool Pages */
    Route::get('/admission_pool/intake', [App\Http\Controllers\AdmissionPoolController::class, 'intake']);
    Route::get('/admission_pool/applications', [App\Http\Controllers\AdmissionPoolController::class, 'applications']);
    Route::get('/admission_pool/applications/{admission_id}', [App\Http\Controllers\AdmissionPoolController::class, 'applications_admission']);
    Route::get('/admission_pool/rating', [App\Http\Controllers\AdmissionPoolController::class, 'rating']);
    Route::get('/admission_pool/merit_list', [App\Http\Controllers\AdmissionPoolController::class, 'merit_list']);

    /* Admission Pool API Calls */
    Route::post('/admission_pool/save_intake', [App\Http\Controllers\AdmissionPoolController::class, 'save_intake']);
    Route::post('/admission_pool/update_ratings', [App\Http\Controllers\AdmissionPoolController::class, 'update_ratings']);
    Route::post('/admission_pool/update_admission', [App\Http\Controllers\AdmissionPoolController::class, 'update_admission']);
    Route::get('/admission_pool/fetch_applications/{academic_year_id}', [App\Http\Controllers\AdmissionPoolController::class, 'fetch_applications']);
    Route::post('/admission_pool/migrate_to_students', [App\Http\Controllers\AdmissionPoolController::class, 'migrate_to_students']);


    /* Batch Manager Pages */
    Route::get('/batch_manager/batches', [App\Http\Controllers\BatchManagerController::class, 'batches']);
    Route::get('/batch_manager/teachers', [App\Http\Controllers\BatchManagerController::class, 'teachers']);
    Route::get('/batch_manager/student_pool', [App\Http\Controllers\BatchManagerController::class, 'student_pool']);
    Route::get('/batch_manager/timetable', [App\Http\Controllers\BatchManagerController::class, 'timetable']);

    /* Batch Manager API Calls */
    Route::post('/batch_manager/fetch_teachers', [App\Http\Controllers\BatchManagerController::class, 'fetch_teachers']);
    Route::post('/batch_manager/students', [App\Http\Controllers\BatchManagerController::class, 'students']);
    Route::post('/batch_manager/allocate_student', [App\Http\Controllers\BatchManagerController::class, 'allocate_student']);
    Route::post('/batch_manager/create_batch', [App\Http\Controllers\BatchManagerController::class, 'create_batch']);
    Route::post('/batch_manager/update_batch', [App\Http\Controllers\BatchManagerController::class, 'update_batch']);
    Route::post('/batch_manager/assign_teacher', [App\Http\Controllers\BatchManagerController::class, 'assign_teacher']);

    /* Fee and Services Pages */
    Route::get('/fee_and_services/fee', [App\Http\Controllers\FeeAndServicesController::class, 'fee']);
    Route::get('/fee_and_services/services', [App\Http\Controllers\FeeAndServicesController::class, 'services']);

    /* Fee and Services API Calls */
    Route::post('/fee_and_services/save_fee', [App\Http\Controllers\FeeAndServicesController::class, 'save_fee']);
    Route::post('/fee_and_services/delete_fee', [App\Http\Controllers\FeeAndServicesController::class, 'delete_fee']);
    Route::post('/fee_and_services/save_service', [App\Http\Controllers\FeeAndServicesController::class, 'save_service']);
    Route::post('/fee_and_services/delete_service', [App\Http\Controllers\FeeAndServicesController::class, 'delete_service']);

    /* Timetable Pages */
    Route::get('/timetable/create_timetable', [App\Http\Controllers\TimetableController::class, 'create_timetable']);
    Route::get('/timetable/batch_wise', [App\Http\Controllers\TimetableController::class, 'batch_wise']);
    Route::get('/timetable/teacher_wise', [App\Http\Controllers\TimetableController::class, 'teacher_wise']);

    /* Timetable API Calls */
    Route::post('/timetable/save_timetable', [App\Http\Controllers\TimetableController::class, 'save_timetable']);

});