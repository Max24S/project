@extends('admin.teacher.layouts.teacher')
@section('form')
    <form action="">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Предмет</th>
                <th scope="col">Преподователь</th>
                <th scope="col">
                    <select name="" id="">
                        <option >Выберите день недели</option>
                        <option value="day">Понедельник</option>
                    </select>
                </th>
                <th scope="col">
                    <select name="" id="">
                        <option>Выберите класс</option>
                        <option value="day">1-А</option>
                    </select>
                </th>
            </tr>
            </thead>
            <tbody>
            @for($i=1;$i<9;$i++)
                <tr>
                    <th scope="row">{{$i}}</th>
                    <td>
                        <select name="" id="">
                            <option value="day">-</option>
                            <option value="day">Математика</option>
                        </select>
                    </td>
                    <td>
                        <select name="" id="">
                            <option value="day">-</option>
                            <option value="day">Полох И.В.</option>
                        </select>
                    </td>
                </tr>
            @endfor
            </tbody>
        </table>
        <button type="submit">Cохранить</button>
    </form>
