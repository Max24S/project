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
                        Route::resource('timetable', 'TimetableController');
                    });
            });
    });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
