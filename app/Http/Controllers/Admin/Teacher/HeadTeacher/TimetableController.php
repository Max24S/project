<?php

namespace App\Http\Controllers\Admin\Teacher\HeadTeacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\Timetable\IndexRequest;
use App\Models\Subject;
use App\Models\Timetable;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests\Timetable\StoreRequest;
use mysql_xdevapi\Result;

class TimetableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grades=(new Timetable())->getGrades()->get();

        return view('admin.teacher.head-teacher.timetable.index',compact('grades'));

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Database\Query\Builder
     */
    public function indexTimetable(IndexRequest $request)
    {
        return ['result'=>'OK','timetable'=>(new Timetable())->show($request->grade_id,$request->semester)->get()];
//        return (new Timetable())->show()->get();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
            $teachersAndThemSubjects=collect(["teachers"=>(new Timetable())->getTeachers(),
            "subjects"=>(new Timetable())->getSubjects()->get(),
            "grades"=>(new Timetable())->getGrades()->get(),
            'classrooms'=>(new Timetable())->getClassrooms()->get()]);
       return view('admin.teacher.head-teacher.timetable.create',compact('teachersAndThemSubjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( StoreRequest $request)
    {

       (new Timetable())->addTimeTable($request->all());
        return ['result'=>'OK'];
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
