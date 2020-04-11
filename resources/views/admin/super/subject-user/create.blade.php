@extends('admin.super.layouts.admin')
@section('form')
    <div id="app">
        <create-student :grade="{{json_encode($grade)}}" :student="{{json_encode($student)}}"></create-student>
    </div>
@endsection
