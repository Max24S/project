<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Grade extends Model
{
    private $response;

    protected $fillable = [
        'name', 'user_id', 'classroom_id'
    ];

    public function getAllGrades()
    {
        return DB::table('grades');
    }

    public function getGrades()
    {
        return DB::table('grades')
            ->leftjoin('users','users.id','=','grades.user_id')
            ->leftjoin('classrooms','classrooms.id','=','grades.classroom_id')
            ->get(['grades.id','grades.name as grade','users.name','users.surname','users.patronymic','classrooms.name as classroom']);
    }

    public static function find(string $string)
    {

    }

    public function prepareFromCreate($grade)
    {
        $uniqueName = $this->uniqueName($grade['name']);
        $uniqueCurator = $this->uniqueCurator($grade['user_id']);
        $uniqueClassroom = $this->uniqueClassroom($grade['classroom_id']);

        if($uniqueName&&$uniqueCurator&&$uniqueClassroom){

            Grade::create($grade);

            return ['response'=>'created'];
        }

        $this->response['response']='duplicate';

        return $this->response;
    }

    public function uniqueName($name)
    {
        $check = Grade::where('name',$name)->first();

        if($check){

            $this->response['name']='duplicate';

            return false;
        }

        return true;

    }

    public function uniqueCurator($user_id)
    {
        if($user_id==null){

            return true;
        }
        $check = Grade::where('user_id',$user_id)->first();

        if($check){

            $this->response['user_id']='duplicate';

            return false;
        }

        return true;

    }

    public function uniqueClassroom($classroom_id)
    {
        if($classroom_id==null){

            return true;
        }
        $check = Grade::where('classroom_id',$classroom_id)->first();

        if($check){

            $this->response['classroom_id']='duplicate';

            return false;
        }

        return true;

    }
}
