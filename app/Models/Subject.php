<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Subject extends Model
{
    protected $fillable = [
        'name'
    ];

    public function  prepareFromCreate($subject)
    {
        if($this->uniqueName($subject['name'])){

           Subject::create(['name'=>$subject['name']]);

           return ['response'=>'created'];
        }

        return ['response' => 'duplicate'];
    }

    public function uniqueName($name)
    {
        $check = Subject::where('name',$name)->first();

        if($check){

            return false;
        }

        return true;
    }

    public function getSubjects()
    {
        return DB::table('subjects');
    }
}
