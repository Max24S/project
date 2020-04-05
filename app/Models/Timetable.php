<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Timetable extends Model
{

    protected $fillable = ['lesson','teach_id','grade_id','classroom_id','name','description','status','created_at','updated_at'];



    public function show($grade,$semester)
    {
        return DB::table('timetables')
            ->join ('subject_user','timetables.subject_user_id','=','subject_user.id')
            ->join('grades','timetables.grade_id','=','grades.id')
            ->join('subjects','subject_user.subject_id','=','subjects.id')
            ->join('users','subject_user.user_id','=','users.id')
            ->join('classrooms','timetables.classroom_id','=','classrooms.id')
            ->where('timetables.grade_id','=',$grade)
            ->where('timetables.semester','=',$semester)
            ->select('timetables.day',
                            'timetables.semester');
    }

    public function getTeachers()
    {
        return DB::table('subject_user')
            ->join('subjects','subject_user.subject_id','=','subjects.id')
            ->join('users','subject_user.user_id','=','users.id')
            ->select('users.id as user_id',
                            'subject_user.id',
                            'users.name as teachers',
                            'subjects.id as subject_id',
                            'subjects.name as subjects');
    }
    public function getSubjects()
    {
        return DB::table('subjects')
            ->select('id','name');
    }
    public function getGrades()
    {
        return DB::table('grades')
            ->select('id','name');
    }
    public function  getClassrooms()
    {
        return DB::table('classrooms')
            ->select('id','name');
    }
    public function  addTimeTable($request)
    {
        for ($i=1;$i<=count($request);$i++)
        {
            $request[$i]['created_at']=date('Y-m-d H:i:s');
            $request[$i]['updated_at']=date('Y-m-d H:i:s');
        }
        DB::table('timetables')->insert($request);
    }
}


