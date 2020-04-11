
@extends('admin.super.layouts.admin')

@section('table')

    <div id="app">
        <index-student :students="{{json_encode($students)}}" :grade="{{json_encode($grade)}}"></index-student>
    </div>

@endsection
