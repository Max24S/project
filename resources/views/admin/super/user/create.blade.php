@extends('admin.super.layouts.admin')

@section('form')

    <div id="app">
        <create-user :grades="{{json_encode($grades)}}"></create-user>
    </div>

@endsection

<script>
    window.routes = {
        'admin.super.user.store' : '{{ route('admin.super.user.store') }}',
    }
</script>
