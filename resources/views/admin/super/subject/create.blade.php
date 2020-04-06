@extends('admin.super.layouts.admin')
@section('form')
    <div id="app">
        <create-subject :teachers="{{json_encode($teachers)}}"></create-subject>
    </div>
@endsection

<script>
    window.routes = {
        'admin.super.subject.store' : '{{ route('admin.super.subject.store') }}',
    }
</script>
