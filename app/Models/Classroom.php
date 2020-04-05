<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Classroom extends Model
{
    //
    protected  $fillable = ['name'];

    public function grade()
    {
        return $this->hasOne(Grade::class);
    }

    public function getAll(){

        return DB::table('classrooms');
    }

    public function prepareFromCreate($classroom)
    {
        if($this->uniqueName($classroom['name']))
        {
            Classroom::create($classroom);

            return ['response'=>'created'];
        }
        else {

            return ['response'=>'nameDuplicate'];
        }

    }

    public function uniqueName($name)
    {
        $check = Classroom::where('name',$name)->first();

        if($check){

            return false;
        }

        return true;
    }
}
