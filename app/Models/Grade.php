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

        if($uniqueName){

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
}
