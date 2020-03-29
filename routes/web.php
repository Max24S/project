<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/8', function () {
    return view('admin.super.index');
});
Route::get('/1', function () {
        return view('admin.super.user.staff.create');
});
Route::get('/2', function () {
    return view('admin.super.user.student.create');
});
Route::get('/3', function () {
    return view('admin.super.subject.create');
});
Route::get('/4', function () {
    return view('admin.super.grade.create');
});
Route::get('/5', function () {
    return view('admin.super.classroom.create');
});
Route::get('/headteacher', function () {
    return view('admin.staff.head-staff.timetable.create');
});
Route::get('/staff', function () {
    return view('admin.staff.homework.create');
});
Route::prefix('Admin')
    ->namespace('Admin\Super')
    ->name('user')
    ->group(function () {
    Route::resource('/', 'UserController');
});


//Route::get('/create-user/{role}', 'UserController@create');
//Route::get('/create-subject', 'SubjectController@create');
//Route::get('/create-grade', 'GradeController@create');
//Route::get('/create-classroom', 'ClassroomController@create');
