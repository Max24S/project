@extends('admin.super.layouts.admin')

@section('form')

<div id="app">
    <edit-classroom :classroom="{{json_encode($classroom)}}"></edit-classroom>
</div>
@endsection


