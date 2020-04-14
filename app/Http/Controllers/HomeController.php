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
                    $grade_id = (new Grade())->getStudentGrade();
                    $subjects=[];
                    if(isset($grade_id[0]->id)){
                        $subjects = (new Subject())->getSubjectsForHomework($grade_id[0]->id);
                    }

                    return view('student.homework.index',compact('subjects'));
                case'Завуч':

                    $initialParameters['grade']=null;
                    $initialParameters['semester']=null;
                    $grades=(new Timetable())->getGrades()->get();
                    return view('admin.teacher.homework.index',compact('grades','initialParameters'));;
                case'Учитель':
                    return view('admin.teacher.index');
                case'Админ':
                    $users = (new User())
                        ->getAll()
                        ->get();

                    return view('admin.super.user.index',compact('users'));
            }
        }
    }
}
