<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Student extends Model
{
    protected $fillable = ['grade_id','user_id'];

    public function getStudentGrade($id) {

        return DB::table('students')
            ->join('grades','grades.id',"=",'students.grade_id')
            ->where('students.user_id',$id)
            ->get(['students.grade_id','grades.name']);
    }
}
