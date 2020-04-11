@extends('admin.super.layouts.admin')
@section('form')
    <div id="app">
        <create-subject-user :id="{{json_encode($id)}}" :teachers="{{json_encode($teachers)}}"></create-subject-user>
    </div>
@endsection
