@extends('admin.super.layouts.admin')

@section('form')

    <div id="app">
        <edit-user :grades="{{json_encode($grades)}}"></edit-user>
    </div>

@endsection

<script>
    window.routes = {
        'admin.super.user.store' : '{{ route('admin.super.user.store') }}',
    }
</script>
