@extends('admin.teacher.layouts.teacher')
@section('nav')
    @include('admin.teacher.head-teacher.layouts.blocks.nav.index')
@endsection
@section('form')
    <div id="app">
        <index-timetable :grades="{{json_encode($grades)}}"></index-timetable>
    </div>
    <div id="app">

    </div>
@endsection
<script>
    window.routes = {
        'admin.teacher.head-teacher.timetable.index' : '{{ route('admin.teacher.head-teacher.timetable.index') }}',
        'admin.teacher.head-teacher.timetable.indexTimetable' : '{{ route('admin.teacher.head-teacher.timetable.indexTimetable') }}'
    }
</script>