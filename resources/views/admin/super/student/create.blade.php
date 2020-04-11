@extends('admin.super.layouts.admin')

@section('form')

    <div id="app">
        <create-student :students="{{json_encode($students)}}" :grade="{{json_encode($grade)}}"></create-student>
    </div>

@endsection
