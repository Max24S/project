<?php

namespace App\Http\Controllers;

use App\Models\Timetable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        if(isset($user->role)) {
            switch ($user->role) {
                case'Ученик':
                    return view('student.index');
                case'Завуч':

                    $initialParameters['grade']=null;
                    $initialParameters['semester']=null;
                    $grades=(new Timetable())->getGrades()->get();
                    return view('admin.teacher.homework.index',compact('grades','initialParameters'));;
                case'Учитель':
                    return view('admin.teacher.index');
                case'Админ':
                    return view('admin.super.index');
            }
        }
    }
}
