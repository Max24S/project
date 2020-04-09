@extends('admin.super.layouts.admin')

@section('form')

    <div id="app">
        <edit-user :user="{{json_encode($user)}}" :student-data="{{json_encode($studentData)}}"></edit-user>
    </div>

@endsection


