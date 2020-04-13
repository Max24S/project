<?php

namespace App\Http\Controllers\Admin\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\Homework\IndexRequest;
use App\Models\Homework;
use App\Models\Timetable;
use Illuminate\Http\Request;

use App\Http\Requests\Homework\StoreRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($grade=null,$semester=null)
    {
        $initialParameters['grade']=$grade;
        $initialParameters['semester']=$semester;
        $grades=(new Timetable())->getGrades()->get();

        return view('admin.teacher.homework.index ',compact('grades','initialParameters'));
    }
    public function indexHomework(IndexRequest $request)
    {
//        return (new Homework())->getHomework($request->all());
        $id =Auth::id();
        $teacher=(new Homework())->getUser($id);
        return ['result'=>'OK','timetable'=>(new Homework())->getHomework($request->all()),'teacher'=>$teacher];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.teacher.homework.create');
    }
    public function StoreHomeWork(Request $request)
    {
        return (new Homework())->addHomeWork($request->all());
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {

        Homework::create($request->all());
        return redirect()->route('admin.teacher.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Homework  $homework
     * @return \Illuminate\Http\Response
     */
    public function show(Homework $homework)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Homework  $homework
     * @return \Illuminate\Http\Response
     */
    public function edit(Homework $homework)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Homework  $homework
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Homework $homework)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Homework  $homework
     * @return \Illuminate\Http\Response
     */
    public function destroy(Homework $homework)
    {
        //
    }
}
