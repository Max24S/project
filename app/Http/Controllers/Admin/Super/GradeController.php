<?php

namespace App\Http\Controllers\Admin\Super;

use App\Http\Requests\Grade\StoreRequest;
use App\Models\Classroom;
use App\Models\Grade;
use App\Http\Controllers\Controller;
use App\Models\User;

use function GuzzleHttp\Promise\all;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classrooms = (new Classroom())
            ->noClassroom()
            ->get(['classrooms.id','classrooms.name']);

        $users = (new User())
            ->noGrade()
            ->get(['users.id','users.name','users.surname','users.patronymic']);

        $dataFromSelect=['classrooms'=>$classrooms,'users'=>$users];

        return view('admin.super.grade.create',compact('dataFromSelect'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $result = (new Grade())->prepareFromCreate($request->all());

        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function show(Grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function edit(Grade $grade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grade $grade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grade $grade)
    {
        //
    }
}
