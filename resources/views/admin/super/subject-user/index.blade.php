@extends('admin.super.layouts.admin')

@section('table')

    <div id="app">
       <index-subject-user :teachers="{{json_encode($teachers)}}"></index-subject-user>
    </div>

@endsection
