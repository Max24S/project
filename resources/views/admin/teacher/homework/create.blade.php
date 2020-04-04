@extends('admin.teacher.layouts.teacher')
@section('nav')
    @include('admin.teacher.layouts.blocks.nav.index')
@endsection

@section('form')
    @php
        $class='10-A';
        $date='100' ;
    @endphp
    <form action="{{route('admin.teacher.homework.store')}}" method="post">
        @csrf
       <div class="information">
           Класс
            {{-- <select name="class" id="">--}}
           {{--               <option value="class1">10-A</option>--}}
           {{--           </select>--}}
           {{--           Дата домашней работы--}}
           {{--           <select name="date" id="">--}}
           {{--               <option value="date1">10-A-{{$class}}</option>--}}
           {{--           </select>--}}
       </div>
        <div>

            <input  type="text" name="teach_id" id="" >
            @error('teach_id')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input  type="text" name="grade_id" id="" >
            @error('grade_id')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            Задание
            <input  type="text" name="name" id="" >
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            Комментарии
            <textarea name="description" id="" cols="30" rows="10" ></textarea>
            @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            Статус
            <select name="status" id="">
                <option value="default">Выьерите статус дз</option>
                <option >Выдано</option>
            </select>
            @error('status')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <button value="save" type="submit">Cохранить</button>
    </form>
    @php
    dd($res);
     @endphp
    <style>
        textarea {
            resize: none !important; /* Запрещаем изменять размер */
        }
    </style>
