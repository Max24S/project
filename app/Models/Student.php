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

    public function updateStudent($user_id,$grade_id) {

            Student::update(['grade_id'=>$grade_id])->where('user_id',$user_id);
    }
}
