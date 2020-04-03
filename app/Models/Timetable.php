<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Timetable extends Model
{
//    protected $table='timetables';
    protected $fillable = ['lesson','teach_id','grade_id','classroom_id','name','description','status'];

    public function show()
    {
        return  DB::table($this->table)
            ->join ('teach','timetables.teach_id','=','teach.id')
            ->join('grades','timetables.grade_id','=','grades.id')
            ->join('subjects','teach.subject_id','=','subjects.id')
            ->join('users','teach.user_id','=','users.id')
            ->join('classrooms','timetables.classroom_id','=','classrooms.id')
            ->select('timetables.day',
                            'classrooms.name',
                            'users.name',
                            'users.surname',
                            'users.patronymic',
                            'subjects.name',
                            'timetables.semester');
    }

    public function getTeachersAndSubjects()
    {
        return DB::table('teach')
            ->join('subjects','teach.subject_id','=','subjects.id')
            ->join('users','teach.user_id','=','users.id')
            ->select('users.name as teachers',
                              'subjects.name as subject');
    }

}


