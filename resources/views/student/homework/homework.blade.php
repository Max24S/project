@extends('student.layouts.student')

@section("content")
    <div id="app">
        <index-homework :homeworks="{{json_encode($homeworks)}}" :subject="{{json_encode($subject)}}"></index-homework>
    </div>
@endsection
