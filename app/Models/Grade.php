<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    private $response;

    protected $fillable = [
        'name', 'user_id', 'classroom_id'
    ];
    public static function find(string $string)
    {

    }

    public function classes()
    {
        return $this->belongsTo(Classroom::class,'classroom_id','id');
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
