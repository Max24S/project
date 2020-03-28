@extends('admin.layouts.admin')
@section('form')
<div class="container">
    <form class="form-horizontal" role="form">
        <h2>Добавление класса</h2>
        <div class="form-group">
            <label for="Name" class="col-sm-3 control-label">Название класса</label>
            <div class="col-sm-9">
                <input type="text" id="Name" placeholder="Класс..." class="form-control" autofocus>
            </div>
        </div>
        <div class="form-group col-md-6">
            <select id="inputState" class="form-control">
                <option selected>Выбор руководителя</option>
                <option>1</option>
                <option>1</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <select id="inputState" class="form-control">
                <option selected>Выбор кабинета</option>
                <option>1</option>
                <option>1</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Register</button>
    </form>
</div>
@endsection
