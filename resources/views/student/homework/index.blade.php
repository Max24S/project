@extends('student.layouts.student')

@section("content")
    <div id="app">
        <index-subject-student :subjects="{{json_encode($subjects)}}"></index-subject-student>
    </div>
@endsection
