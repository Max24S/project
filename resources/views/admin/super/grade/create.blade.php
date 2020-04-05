@extends('admin.super.layouts.admin')
@section('form')

<div id="app">
    <create-grade :classrooms-and-teachers="{{json_encode($dataFromSelect)}}"></create-grade>
</div>
@endsection

<script>
    window.routes = {
        'admin.super.grade.store' : '{{ route('admin.super.grade.store') }}',
    }
</script>

