<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Timetable extends Model
{

    protected $fillable = ['lesson','teach_id','grade_id','classroom_id','name','description','status','created_at','updated_at'];

    public function show($grade,$semester)
    {
        return DB::table('timetables')
            ->leftJoin ('subject_user','timetables.subject_user_id','=','subject_user.id')
            ->leftJoin('grades','timetables.grade_id','=','grades.id')
            ->leftJoin('subjects','subject_user.subject_id','=','subjects.id')
            ->leftJoin('users','subject_user.user_id','=','users.id')
            ->leftJoin('classrooms','timetables.classroom_id','=','classrooms.id')
            ->where('timetables.grade_id','=',$grade)
            ->where('timetables.semester','=',$semester)
            ->select('timetables.day',
                            'timetables.semester',
                            'timetables.lesson',
                            'grades.name as grade',
                            'classrooms.name as classroom',
                            'users.name',
                            'users.surname',
                            'users.patronymic',
                            'subjects.name as subjects',
                            'timetables.id')
            ->get();
    }
    public function timetableFormation($grade,$semester)
    {
        $dbTimetableData=$this->show($grade,$semester);

        $timetable=[];
        $Sorted = $dbTimetableData->sortBy('lesson')->groupBy('day')->toArray();
        for ($i=0;$i<=7;$i++)
        {
            $lessonForDays=['lesson'=>$i+1,
                "monday"=>$Sorted['Понедельник'][$i]??' ',
                "tuesday"=>$Sorted['Вторник'][$i]??' ',
                "wednesday"=>$Sorted['Среда'][$i]??' ',
                "thursday"=>$Sorted['Четверг'][$i]??' ',
                "friday"=>$Sorted['Пятница'][$i]??' ',
                "saturday"=>$Sorted['Суббота'][$i]??' ',
            ];
            array_push($timetable,$lessonForDays);
        }
        return $timetable;
        }

    public function getTeachers()
    {
        return DB::table('subject_user')
            ->join('subjects','subject_user.subject_id','=','subjects.id')
            ->join('users','subject_user.user_id','=','users.id')

              ->get(['users.id as user_id',
                'subject_user.id',
                'users.name as teachers',
                'subjects.id as subject_id',
                'subjects.name as subjects']);
    }
    public function uniqueTeacher($lesson){

        $check = DB::table('timetables')->where('day',$lesson['day'])
                 ->where('lesson',$lesson['lesson'])
                ->where('subject_user_id',$lesson['subject_user_id'])
            ->where('subject_user_id','<>',null)
                ->where('semester',$lesson['semester'])->first();
        if($check){

            return false;
        }
        return true;
    }
    public function checkLesson($lesson)
    {
        $check = DB::table('timetables')
            ->where('day',$lesson['day'])
            ->where('lesson',$lesson['lesson'])
            ->where('grade_id',$lesson['grade_id'])
            ->where('semester',$lesson['semester'])->first();
        if($check){

            return false;
        }
        return true;
    }
    public function getSubjects()
    {
        return DB::table('subjects')
            ->select('id','name');
    }
    public function getGrades()
    {
        return DB::table('grades')
            ->select('id','name');
    }
    public function  getClassrooms()
    {
        return DB::table('classrooms')
            ->select('id','name');
    }
    public function  addTimeTable($request)
    {
        $result=[];
        $response=[];
        $response['duplicate']=[];
        $response['result']='';
        if(!$this->checkLesson($request[1])) {
            $response['result']='isset';
            return $response;
        }
        foreach ($request as $item) {
            if ($this->uniqueTeacher($item)) {
                $item['created_at'] = date('Y-m-d H:i:s');
                $item['updated_at'] = date('Y-m-d H:i:s');
                array_push($result, $item);
            }
            else {
                $response['duplicate']['lesson'.$item['lesson']]='duplicate';
            }
        }
        if (!count($response['duplicate'])) {
            DB::table('timetables')->insert($result);
            $response['result']='OK';
        }
        return $response;
    }
}
