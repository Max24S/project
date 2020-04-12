<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Homework extends Model
{
    protected $fillable = ['teach_id','grade_id','name','description'];

    public function getUser($id){

          return DB::table('subject_user')
            ->join('users','users.id',"=",'subject_user.user_id')
            ->join('subjects','subjects.id','=','subject_user.subject_id')
            ->where('subject_user.user_id','=',$id)
            ->get([
                'users.id',
                'users.name',
                'users.surname',
                'users.patronymic',
                'subjects.name as subject',
            ]);
    }

}
