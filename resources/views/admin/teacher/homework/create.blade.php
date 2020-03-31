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
            Задание
            <input  type="text" name="name" id="" >
            Комментарии
            <textarea name="description" id="" cols="30" rows="10" ></textarea>
            Статус
            <select name="`status" id="">
                <option value="status_1">Выдано</option>
            </select>
        </div>
        <button value="save" type="submit">Cохранить</button>
    </form>

    <style>
        textarea {
            resize: none !important; /* Запрещаем изменять размер */
        }
    </style>
