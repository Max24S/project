@extends('admin.super.layouts.admin')

@section('table')

    <div id="app">
        <index-user :users="{{json_encode($users)}}"></index-user>
    </div>

@endsection

<script>
    window.routes = {
        'admin.super.user.index' : '{{ route('admin.super.user.index') }}',
        {{--'admin.super.user.destroy' : '{{ route('admin.super.user.destroy') }}',--}}
    }
</script>
