@extends('admin.super.layouts.admin')

@section('table')

    <div id="app">
        <index-grade :grades="{{json_encode($grades)}}"></index-grade>
    </div>

@endsection

