@extends('admin.super.layouts.admin')
@section('form')
<div id="app">
    <create-grade :val="{{$teachersAndClassrooms}}"></create-grade>
</div>
@endsection

<script>
    window.routes = {
        'admin.super.grade.store' : '{{ route('admin.super.grade.store') }}',
    }
</script>

