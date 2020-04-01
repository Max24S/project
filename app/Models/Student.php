<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['grade_id','user_id'];

    public  function prepareFromCreate($grade_id,$email)
    {
        $user = User::where('email', $email)->get('id');
        $user_id= $user
            ->map(function ($user) {
                return $user->id;
            })->get(0);


        Student::create(['grade_id'=>$grade_id,'user_id'=>$user_id]);
    }
}
