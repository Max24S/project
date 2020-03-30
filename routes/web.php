<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'admin.teacher.head-teacher.index')->name('welcome');
Route::name('admin.')
    ->namespace('Admin')
    ->prefix('admin')
    ->group(function () {

        Route::prefix('super')
            ->name('super.')
            ->namespace('Super')
            ->group(function () {
                Route::resource('classroom', 'ClassroomController');
                Route::resource('grade', 'GradeController');
                Route::resource('subject', 'SubjectController');
                Route::resource('student', 'StudentController');
                Route::resource('staff', 'StaffController');

            });
        Route::prefix('teacher')
            ->name('teacher.')
            ->namespace('Teacher')
            ->group(function () {
                Route::resource('homework', 'HomeworkController');
                Route::prefix('head-teacher')
                    ->namespace('HeadTeacher')
                    ->name('head-teacher.')
                    ->group(function () {
                        Route::resource('timetable', 'TimetableController');
                    });
            });
    });

