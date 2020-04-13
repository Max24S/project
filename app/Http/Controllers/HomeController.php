<?php

namespace App\Http\Controllers;

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
                    return view('admin.teacher.head-teacher.index');
                case'Учитель':
                    return view('admin.teacher.index');
                case'Админ':
                    return view('admin.super.index');
            }
        }
    }
}
