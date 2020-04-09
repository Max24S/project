@extends('admin.super.layouts.admin')

@section('form')

    <div id="app">
        <edit-subject :subject="{{json_encode($subject)}}"></edit-subject>
    </div>

@endsection
