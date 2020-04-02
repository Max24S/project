@extends('admin.teacher.layouts.teacher')
@section('nav')
    @include('admin.teacher.head-teacher.layouts.blocks.nav.index')
@endsection
@section('form')
    <form action="{{route('admin.teacher.head-teacher.timetable.store')}}" method="post">
        @csrf
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Урок</th>
                <th scope="col">Предмет</th>
                <th scope="col">Преподователь</th>
                <th scope="col">
                    <select name="day" id="">
                        <option value="default">Выберите день недели</option>
                        <option>Понедельник</option>
                    </select>
                    @error('day')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </th>
                <th scope="col">
                    <select name="grade_id" id="">
                        <option value="default">Выберите класс</option>
                        <option value="1">1-А</option>
                    </select>
                    @error('grade_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </th>
                <th scope="col">
                    <select name="classroom_id" id="">
                        <option value="default">Выберите класс</option>
                        <option value="1">1-А</option>
                    </select>
                    @error('grade_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </th>
                <th scope="col">
                    <select name="semester" id="">
                        <option value="default">Выберите семестр</option>
                        <option >1</option>
                        <option >2</option>
                    </select>
                    @error('semester')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </th>
            </tr>
            </thead>
            <tbody>
            @for($i=1;$i<9;$i++)
                <tr>
                    <th scope="row">
                        <div name="lesson{{$i}}">{{$i}}</div>
                        <input type="hidden" name="lesson{{$i}}" value="{{$i}}" id="">
                    </th>
                    <td>
                    <select name="subject{{$i}}" id="">
                        <option value="default">Выберите предмет</option>
                        <option value="1">Математика</option>
                    </select>
                    @error("subject".$i)
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    </td>
                    <td>
                        <select name="teach_id{{$i}}" id="">
                            <option value="default">Выберите преподователя</option>
                            <option value="1">Полох И.В.</option>
                        </select>
                        @error("teach_id".$i)
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>
            @endfor
            </tbody>
        </table>
        <button type="submit">Cохранить</button>
        {{dd($res[0]->day)}}
    </form>
@endsection
