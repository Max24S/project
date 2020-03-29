@extends('admin.super.layouts.admin')
@section('form')
    <form class="form-horizontal" role="form">
        <h2>Добавление кабинета</h2>
        <div class="form-group">
            <div class="row">
                <label for="Name" class="col-sm-4 control-label">Номер кабинета</label>
                <div class="col-sm-8">
                    <input type="text" id="Name" placeholder="Кабинет..." class="form-control" autofocus>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Добавить</button>
    </form>
@endsection
