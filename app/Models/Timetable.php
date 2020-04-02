<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Timetable extends Model
{
    protected $fillable = ['lesson','teach_id','grade_id','classroom_id','name','description','status'];

    public function show()
    {
         $result=DB::table('timetables')
            ->join ('teach ','timetables.teach_id','=','teach.id')
            ->join('grades','timetables.grade_id','subjects.id')
            ->join('subjects ','teach.subject_id','subjects.id')
            ->join('users','teach.user_id','users.id')
            ->join('classrooms','timetables.classroom_id','classrooms.id')
            ->select('');
            return $result;

    }
}


