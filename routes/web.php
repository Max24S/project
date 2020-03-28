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

Route::get('/', function () {
        return view('admin.super.user.create');
});
//Route::prefix('Admin')->group(function () {
//
//    Route::resources('/','UserController')
//        ->namespace('Admin')
//        ->name('user');
//
//})

//Route::get('/create-user/{role}', 'UserController@create');
//Route::get('/create-subject', 'SubjectController@create');
//Route::get('/create-grade', 'GradeController@create');
//Route::get('/create-classroom', 'ClassroomController@create');
