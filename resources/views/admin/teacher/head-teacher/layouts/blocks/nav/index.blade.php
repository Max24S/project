@extends('admin.teacher.layouts.blocks.nav.index')
@section('nav-head')
    <li class="nav-item dropdown1">
        <div class="btn-group">
            <button type="button" class="btn btn-1  dropdown-toggle text-white" data-toggle="dropdown" >Расписание</button>
            <div class="dropdown-menu">
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
                <a class="dropdown-item" href="#">Создать</a>
=======
                <a class="dropdown-item" href="{{route('admin.teacher.head-teacher.timetable.create')}}">Создать</a>
>>>>>>> 68647d690d560069f6a19905c1d120c29d2882e4
=======
                <a class="dropdown-item" href="{{route('admin.teacher.head-teacher.timetable.create')}}">Создать</a>
>>>>>>> 13ed31e956dc045c9d9d92b2810251e0a8698776
=======
                <a class="dropdown-item" href="{{route('admin.teacher.head-teacher.timetable.create')}}">Создать</a>
>>>>>>> 13ed31e956dc045c9d9d92b2810251e0a8698776
                <a class="dropdown-item" href="#">Редактировать</a>
            </div>
        </div>
    </li>
@endsection

