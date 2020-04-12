@extends('admin.super.layouts.admin')
@section('form')
    <div id="app">
        <create-subject-user :teachers="{{json_encode($teachers)}}" :subject="{{json_encode($subject)}}"></create-subject-user>
    </div>
@endsection
