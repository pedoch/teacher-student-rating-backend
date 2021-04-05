<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function () {
    // Route::post('register', 'AuthController@register');
    // Route::post('store-owner-registration', 'AuthController@registerStoreOwner');
    // Route::post('update-changed-password', 'AuthController@changePassword');
    Route::post('login', 'AuthController@login');
    // Route::post('logout', 'AuthController@logout');
    Route::get('sign-out', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    // Route::get('session/get','AuthController@accessSessionData');
    // Route::get('session/set','AuthController@storeSessionData');
    // Route::get('session/remove','AuthController@deleteSessionData');
});


Route::group([
    'middleware' => ['api','access_token'],
], function () {
    Route::get('get-all-sections', 'Controller@fetchAllSections');
    Route::get('get-all-section-question', 'Controller@fetSectionAndQuestions');
    Route::get('get-evaluation-questions', 'Controller@fetchEvaluationQuestions');
    Route::get('get-all-department', 'Controller@fetchAllDepatments');
    Route::get('get-all-teachers', 'Controller@getAllTeachers');
    Route::get('get-department-teachers/student/user={id}/type={type}', 'Controller@getDepartmentTeachers');
    Route::get('get-department-rated-teachers/student/user={id}/type={type}', 'Controller@getRatedDepartmentTeachers');
    Route::get('get-all-student', 'Controller@getAllStudents');
    Route::get('get-department-student/user={id}', 'Controller@getDepartmentStudents');
    Route::get('get-course-info/{course_code}', 'Controller@getCourseInfo');
    Route::get('get-teacher-info/{id}', 'Controller@getTeacherInfo');
    Route::post('add-new-teacher', 'Controller@addNewTeacher');
    Route::post('add-new-student', 'Controller@addNewStudent');
    Route::post('add-new-department', 'Controller@addNewDepartment');
    Route::post('add-new-course', 'Controller@addNewCourse');
    Route::post('rate-teacher/{student_id}/{teacher_id}', 'Controller@rateTeacher');
    Route::post('delete-department', 'Controller@deleteDepartment');
    Route::post('enable-disable-rating', 'Controller@enableDisableRating');
    Route::post('update-course', 'Controller@updateCourse');
    Route::post('enroll-course', 'Controller@enrollForCourse');
    Route::post('un-enroll-course', 'Controller@unEnrollForCourse');
    Route::post('finish-rating-course', 'Controller@finishRatingCourse');
    Route::get('enable-all-rating', 'Controller@enableAllRating');
    Route::get('disable-all-rating', 'Controller@disableAllRating');
    Route::get('get-all-course', 'Controller@getAllCourses');
    Route::get('get-enrolled-course/{id}', 'Controller@getAllEnrolledCourses');
    Route::get('get-unenrolled-course/{id}', 'Controller@getAllUnEnrolledCourses');
    Route::get('get-teachers-assessment/{id}', 'Controller@getTeachersAssessment');
    Route::get('get-teachers-assessment-with-teacher-id/{id}', 'Controller@getTeachersAssessmentWithTeacherId');
});
