<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Homework extends Model
{
    protected $fillable = ['subject_user_id','day','lesson','grade_id','name','description','deadline'];

    public function getUser($id){

          return DB::table('subject_user')
            ->join('users','users.id',"=",'subject_user.user_id')
            ->join('subjects','subjects.id','=','subject_user.subject_id')
            ->where('subject_user.user_id','=',$id)
            ->get([
                'users.id',
                'subject_user.id as subject_user_id',
            ]);
    }
    public function timetableFormation($grade,$semester)
    {
        $dbTimetableData=$this->show($grade,$semester);

        $timetable=[];
        $Sorted = $dbTimetableData->sortBy('lesson')->groupBy('day')->toArray();
        $lessonsForDays['Понедельник']=[];
        $lessonsForDays['Вторник']=[];
        $lessonsForDays['Среда']=[];
        $lessonsForDays['Четверг']=[];
        $lessonsForDays['Пятница']=[];
        $lessonsForDays['Суббота']=[];
        foreach ($Sorted as $day) {
            $j=0;
            for ($i = 0; $i <= 7; $i++) {

                if ( $day[$i-$j]??"") {

                    if ($day[$i-$j]->lesson == $i+1) {

                        array_push($lessonsForDays[$day[$i-$j]->day], $day[$i-$j]);
                    }
                    else {
                        array_push($lessonsForDays[$day[$i-$j]->day] , null);
                        $j++;
                    }
                }
                else
                {
                    break;
                }
            }
        }

        for ($i=0;$i<=7;$i++)
        {
            $lessons=[
                'lesson'=>$i+1,
                "monday"=>$lessonsForDays['Понедельник'][$i]??' ',
                "tuesday"=>$lessonsForDays['Вторник'][$i]??' ',
                "wednesday"=>$lessonsForDays['Среда'][$i]??' ',
                "thursday"=>$lessonsForDays['Четверг'][$i]??' ',
                "friday"=>$lessonsForDays['Пятница'][$i]??' ',
                "saturday"=>$lessonsForDays['Суббота'][$i]??' ',
            ];
            array_push($timetable,$lessons);
        }
        return $timetable;

    }
    public function getHomework()
    {
        $dbTimetableData=(new Timetable())->show(1,1);
        $sortedTimetable=$dbTimetableData->sortBy('lesson')->groupBy('day')->toArray();
        $homeworks=DB::table('homeworks')->get();
        $sortedHomeWork=$homeworks->sortBy('lesson')->groupBy('day')->toArray();

        $lessonsForDays['Понедельник']=[];
        $lessonsForDays['Вторник']=[];
        $lessonsForDays['Среда']=[];
        $lessonsForDays['Четверг']=[];
        $lessonsForDays['Пятница']=[];
        $lessonsForDays['Суббота']=[];
        $description['0']=[];
        $description['1']=[];
        $description['2']=[];
        $description['3']=[];
        $description['4']=[];
        $description['5']=[];

        foreach ($sortedTimetable as $day) {
            $j=0;
            for ($i = 0; $i <= 7; $i++) {

                if ( $day[$i-$j]??"") {

                    if ($day[$i-$j]->lesson == $i+1) {
                        $day[$i-$j]->description=$sortedHomeWork[$day[$i-$j]->day][$i-$j]->description??'';
                        $day[$i-$j]->nameHomeWork=$sortedHomeWork[$day[$i-$j]->day][$i-$j]->name??'';
                        $day[$i-$j]->idHomeWork=$sortedHomeWork[$day[$i-$j]->day][$i-$j]->id->id??'';
                        array_push($lessonsForDays[$day[$i-$j]->day], $day[$i-$j] );
                    }
                    else {
                        array_push($lessonsForDays[$day[$i-$j]->day] , null);
                        $j++;
                    }
                }
                else
                {
                    break;
                }
            }
        }

             return $lessonsForDays;

//        for ($i=0;$i<=7;$i++)
//        {
//            $lessons=[
//                'lesson'=>$i+1,
//                "monday"=>$lessonsForDays['Понедельник'][$i]??' ',
//                "tuesday"=>$lessonsForDays['Вторник'][$i]??' ',
//                "wednesday"=>$lessonsForDays['Среда'][$i]??' ',
//                "thursday"=>$lessonsForDays['Четверг'][$i]??' ',
//                "friday"=>$lessonsForDays['Пятница'][$i]??' ',
//                "saturday"=>$lessonsForDays['Суббота'][$i]??' ',
//            ];
//            array_push($timetable,$lessons);
//        }


    }
    public function addHomeWork($request)
    {
        $id='';
        $request['deadline']=Carbon::parse($request['deadline'])->format('Y-m-d');

        $homework=Homework::create($request);
        $id=$homework->id;
        return ['OK',$id];
    }

    public function getHomeworkForSubject($subject_id)
    {   $grade_id = (new Grade())->getStudentGrade();

        return DB::table('homeworks')->join('subject_user','subject_user.id','=','homeworks.subject_user_id')
            ->where('homeworks.grade_id',$grade_id[0]->id)
            ->where('subject_user.subject_id',$subject_id)
            ->get();
    }
}
