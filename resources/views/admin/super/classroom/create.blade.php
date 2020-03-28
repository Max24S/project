@extends('admin.super.layouts.admin')
@section('form')
<div class="container">
    <form class="form-horizontal" role="form">
        <h2>Добавление кабинета</h2>
        <div class="form-group">
            <label for="Name" class="col-sm-3 control-label">Название предмета</label>
            <div class="col-sm-9">
                <input type="text" id="Name" placeholder="Кабинет..." class="form-control" autofocus>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Register</button>
    </form>
</div>
@endsection
