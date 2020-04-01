<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    public static function find(string $string)
    {
    }

    public function classes()
    {
        return $this->belongsTo(Classroom::class,'classroom_id','id');
    }
}
