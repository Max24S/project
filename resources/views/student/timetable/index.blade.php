@extends('student.layouts.student')

@section("content")
    <div id="app">
        <index-timetable-student :grades="{{json_encode($grades)}}"></index-timetable-student>
    </div>
@endsection
