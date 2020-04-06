<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SubjectUser extends Model
{
    protected $fillable = [
        'subject_id','user_id'
    ];

    public function prepareFromCrete($teachers_id,$subject_id)
    {
        $dbData=[];

        for ($i=0;$i<count($teachers_id);$i++)
        {
            $row = [];
            $row['created_at']=date('Y-m-d H:i:s');
            $row['updated_at']=date('Y-m-d H:i:s');
            $row['subject_id']=$subject_id;
            $row['user_id']=$teachers_id[$i];

            array_push($dbData,$row);
        }

        DB::table('subject_user')->insert($dbData);
    }
}
