<?php

namespace App\Http\Controllers\Admin\Super;

use App\Http\Controllers\Controller;
use App\Models\SubjectUser;
use Illuminate\Http\Request;

class SubjectUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public function TeachersForSubject($id,$name)
    {
        $teachers = (new SubjectUser())->getTeachers($id);

        return view('admin.super.subject-user.index',compact('teachers','name'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.super.subject-user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubjectUser  $subjectUser
     * @return \Illuminate\Http\Response
     */
    public function show(SubjectUser $subjectUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubjectUser  $subjectUser
     * @return \Illuminate\Http\Response
     */
    public function edit(SubjectUser $subjectUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubjectUser  $subjectUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubjectUser $subjectUser)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubjectUser  $subjectUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubjectUser $subjectUser)
    {
        $subjectUser->delete();

        return ['response'=>'deleted'];
    }
}
