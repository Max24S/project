@extends('admin.super.layouts.admin')

@section('table')

    <div id="app">
        <index-classroom :classrooms="{{json_encode($classrooms)}}"></index-classroom>
    </div>

@endsection


