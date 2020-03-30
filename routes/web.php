<?php

use Illuminate\Support\Facades\Route;

<<<<<<< HEAD
<<<<<<< HEAD

<<<<<<< HEAD
Route::view('/', 'admin.teacher.head-teacher.timetable.create')->name('welcome');
=======
Route::view('/', 'admin.teacher.head-teacher.index')->name('welcome');
>>>>>>> 68647d690d560069f6a19905c1d120c29d2882e4
=======
цуй
Route::view('/', 'admin.teacher.head-teacher.index')->name('welcome');
>>>>>>> 13ed31e956dc045c9d9d92b2810251e0a8698776
=======
цуй
Route::view('/', 'admin.teacher.head-teacher.index')->name('welcome');
>>>>>>> 13ed31e956dc045c9d9d92b2810251e0a8698776
Route::name('admin.')
    ->namespace('Admin')
    ->prefix('admin')
    ->group(function () {

        Route::prefix('super')
            ->name('super.')
            ->namespace('Super')
            ->group(function () {
                Route::view('/','admin.super.index');
                Route::resource('classroom', 'ClassroomController');
                Route::resource('grade', 'GradeController');
                Route::resource('subject', 'SubjectController');
                Route::resource('student', 'StudentController');
                Route::resource('staff', 'StaffController');
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD

            });


        Route::view('/', 'admin.teacher.index');

//        Route::prefix('super')
//            ->name('super.')
//            ->namespace('Super')
//            ->group(function () {
//                Route::resource('/', 'ClassroomController');
//            });
=======
>>>>>>> b4d31f5182d991f0b0abff4c6bee60a51c0b4f26
=======
>>>>>>> 68647d690d560069f6a19905c1d120c29d2882e4
=======
>>>>>>> 13ed31e956dc045c9d9d92b2810251e0a8698776
=======
>>>>>>> 13ed31e956dc045c9d9d92b2810251e0a8698776

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

