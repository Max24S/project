<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Homework extends Model
{
    protected $fillable = ['subject_user_id','grade_id','name','description','deadline'];

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
                'subject_user.id as subject_user_id',
                'subjects.name as subject',
            ]);
    }
    public function addHomeWork($request)
    {
         $request['date']=Carbon::parse($request['date'])->format('Y-m-d');
        Homework::create($request);
        return ['OK'];
    }

}
