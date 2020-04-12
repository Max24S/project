<?php

use Illuminate\Support\Facades\Route;

Route::get('/1', 'Mail\MailController@send');
Route::view('/', 'admin.teacher.head-teacher.index')->name('welcome');
Route::name('admin.')
    ->namespace('Admin')
    ->prefix('admin')
    ->group(function () {

        Route::prefix('super')
            ->name('super.')
            ->namespace('Super')
//            ->middleware(['auth','role:Админ'])
            ->group(function () {
                Route::view('/','admin.super.index');
                Route::resource('classroom', 'ClassroomController');
                Route::resource('grade', 'GradeController');
                Route::resource('subject', 'SubjectController');
                Route::resource('user', 'UserController');
                Route::resource('student', 'StudentController');
                Route::resource('subject-user', 'SubjectUserController');
                Route::get("subject-user/index/{id}/{name}",'SubjectUserController@teachersForSubject');
                Route::get("student/index/{id}/{name}",'StudentController@studentsForGrade');
                Route::put("user/{user} ",'UserController@update');
                Route::put("subject/{subject} ",'SubjectController@update');
                Route::put("grade/{grade} ",'GradeController@update');
                Route::put("classroom/{classroom} ",'ClassroomController@update');
                Route::get("subject-user/create/{id}/{name} ",'SubjectUserController@createForm');
                Route::get("student/create/{id}/{name} ",'StudentController@createForm');

            });
        Route::prefix('teacher')
            ->name('teacher.')
            ->namespace('Teacher')
            ->group(function () {
                Route::view('/','admin.teacher.index');
                Route::resource('homework', 'HomeworkController');
                Route::prefix('head-teacher')
                    ->namespace('HeadTeacher')
                    ->name('head-teacher.')
                    ->group(function () {
                        Route::view('/','admin.teacher.head-teacher.index');
                        Route::get('/timetable/index/{grade?}/{semester?}','TimetableController@index')->name('timetable');
                        Route::put('/timetable/{timetable}','TimetableController@update');
                        Route::post('/timetable/StoreLesson','TimetableController@StoreLesson');
                        Route::post('/timetable/indexTimetable','TimetableController@indexTimetable')->name('timetable.indexTimetable');
                        Route::resource('timetable', 'TimetableController');
                    });
            });
    });

Route::name('student.')
    ->namespace('User')
    ->prefix('student')
    ->group(function () {

        Route::view('/','student.index');
        Route::resource('timetable', 'TimetableController');
        Route::resource('homework', 'HomeworkController');
        Route::get("timetable-index/{id}/{semester}",'TimetableController@getTimetable');
    });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
