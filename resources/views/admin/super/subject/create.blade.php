@extends('admin.super.layouts.admin')
@section('form')
<div class="container">
    <form class="form-horizontal" role="form">
        <h2>Добавление предмета</h2>
        <div class="form-group">
            <div class="row">
                <label for="Name" class="col-sm-4 control-label">Название предмета</label>
                <div class="col-sm-8">
                    <input type="text" id="Name" placeholder="Предмет..." class="form-control" autofocus>
                </div>
            </div>
        </div>
        <div class="form-group col-md-6">
            <select id="inputState" class="form-control" >
                <option selected>Выбор преподавателей</option>
                <option>3</option>
                <option>1</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Добавить</button>
    </form>
</div>
@endsection

