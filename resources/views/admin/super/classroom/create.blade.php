@extends('admin.super.layouts.admin')
@section('form')
    <div id="app">
        <create-classroom></create-classroom>
    </div>
@endsection

<script>
    window.routes = {
        'admin.super.classroom.store' : '{{ route('admin.super.classroom.store') }}',
    }
</script>
