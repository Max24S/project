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
                <th scope="col">#</th>
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
                        <option >1-А</option>
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
                    <th scope="row">{{$i}}</th>
                    <td>
                    <select name="ddd" id="">
                        <option value="default">Выберите предмет</option>
                        <option>Математика</option>
                        @error('ddd')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </select>
                    </td>
                    <td>
                        <select name="teach_id" id="">
                            <option value="default">Выберите преподователя</option>
                            <option value="day">Полох И.В.</option>
                        </select>
                        @error('teach_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>
            @endfor
            </tbody>
        </table>
        <button type="submit">Cохранить</button>
    </form>
@endsection
