@extends('admin.teacher.layouts.teacher')
@section('form')
    @php
        $class='10-A';
        $date='100' ;
    @endphp
    <form action="">
       <div class="information">
           Класс
           <select name="class" id="">
               <option disabled value="">
                   {{$class}}
               </option>
               <option value="">10-A</option>
           </select>
           Дата домашней работы
           <select name="" id="">
               <option disabled value="">
                   {{$date}}
               </option>
               <option value="">10-A-{{$class}}</option>
           </select>
       </div>
        <div>
            Задание
            <input type="text" name="name" id="" >
            Комментарии
            <textarea name="description" id="" cols="30" rows="10" ></textarea>
            Статус
            <select name="`status" id="">
                <option value="">Выдано</option>
            </select>
        </div>

        <button value="edit" type="submit">Изменить</button>
        <button value="save" type="submit">Cохранить</button>
    </form>
    <style>
        textarea {
            resize: none !important; /* Запрещаем изменять размер */
        }
    </style>
