@extends('admin.super.layouts.admin')
@section('form')
    <div id="app">
        <create-subject></create-subject>
    </div>

    <table v-if="selected.length" class="table">
        <thead>
        <tr>
            <th>Выбран</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="item in selectetTeachers">
            <td><a  target="_blank">{{item.name}}</a></td>
        </tr>
        </tbody>
    </table>

@endsection

