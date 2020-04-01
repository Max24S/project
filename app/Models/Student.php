<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['grade_id','user_id'];

    public  function prepareFromCreate($grade,$email)
    {

        $grade_id = Grade::where('grade', $grade)->get();
        $user_id = Grade::where('email', $email)->get();


    }
}
