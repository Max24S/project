@extends('admin.super.user.create')

@section('title')
    <h2>Добавление ученика</h2>
@endsection

@section('grade')
    <div class="form-group col-md-6">
        <select id="inputState" class="form-control">
            <option selected>Класс</option>
            <option>1</option>
        </select>
    </div>
@endsection
