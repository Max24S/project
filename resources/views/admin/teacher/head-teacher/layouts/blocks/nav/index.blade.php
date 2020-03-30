@extends('admin.teacher.layouts.blocks.nav.index')
@section('nav-head')
    <li class="nav-item dropdown1">
        <div class="btn-group">
            <button type="button" class="btn btn-1  dropdown-toggle text-white" data-toggle="dropdown" >Расписание</button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{route('admin.teacher.head-teacher.timetable.create')}}">Создать</a>
                <a class="dropdown-item" href="#">Редактировать</a>
            </div>
        </div>
    </li>
@endsection
