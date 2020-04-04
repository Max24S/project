@extends('admin.super.layouts.admin')

@section('form')

    <div id="app">
        <create-user></create-user>
    </div>

@endsection

<script>
    window.routes = {
        'admin.super.user.store' : '{{ route('admin.super.user.store') }}',
        'admin.super.classroom.create' : '{{ route('admin.super.classroom.create') }}',
    }
</script>
