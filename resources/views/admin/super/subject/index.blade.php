@extends('admin.super.layouts.admin')

@section('table')

    <div id="app">
        <index-subject :subjects="{{json_encode($subjects)}}"></index-subject>
    </div>

@endsection
