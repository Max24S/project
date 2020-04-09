@extends('admin.super.layouts.admin')

@section('form')

    <div id="app">
        <edit-grade :teachers-classrooms="{{json_encode($dataForSelect)}}" :grade="{{json_encode($grade)}}"></edit-grade>
    </div>

@endsection
