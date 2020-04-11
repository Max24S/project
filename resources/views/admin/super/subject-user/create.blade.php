@extends('admin.super.layouts.admin')
@section('form')
    <div id="app">
        <create-subject-user :subject="{{json_encode($subject)}}" :teachers="{{json_encode($teachers)}}"></create-subject-user>
    </div>
@endsection
