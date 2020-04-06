<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'name'
    ];

    public function  prepareFromCreate($subject)
    {
        if($this->uniqueName($subject['name'])){

           $dbSubject = Subject::create(['name'=>$subject['name']]);
            if($subject['teachers'])
            {
                (new SubjectUser())->prepareFromCrete($subject['teachers'], $dbSubject->id);
            }

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
}
