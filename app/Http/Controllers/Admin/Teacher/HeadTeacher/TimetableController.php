<?php

namespace App\Http\Controllers\Admin\Teacher\HeadTeacher;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Teach;
use App\Models\Timetable;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests\Timetable\StoreRequest;
class TimetableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $timetable=new Timetable();
//        dd($timetable->getSubjects());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
//        $timetable=new Timetable();
//        $user=new User();
       $subjects=Subject::all();
        $teachers=User::with('subjects')->get();
        dd($teachers);
////        $teachers=$user->teaches()->find(1);
//        return $subjects->find(1)->id;
//        $user_id= $user
//            ->map(function ($user) {
//                return $user->id;
//            })->get(0);
//        $teachers= $timetable->getTeachers();
//        dd($teachers->id);

//       return view('admin.teacher.head-teacher.timetable.create',compact('cities'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {


            dd($request->all());

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Timetable  $timetable
     * @return \Illuminate\Http\Response
     */
    public function show(Timetable $timetable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Timetable  $timetable
     * @return \Illuminate\Http\Response
     */
    public function edit(Timetable $timetable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Timetable  $timetable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Timetable $timetable)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Timetable  $timetable
     * @return \Illuminate\Http\Response
     */
    public function destroy(Timetable $timetable)
    {
        //
    }
}
