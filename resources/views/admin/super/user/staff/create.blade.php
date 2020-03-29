@extends('admin.super.user.create')
@section('title')
@section('title')
    <h2>Добавление сотрудника</h2>
@endsection
@endsection
@section('staff')
    <div class="form-group col-md-6">
        <select id="inputState" class="form-control">
            <option selected>Роль</option>
            <option>Директор</option>
            <option>Завуч</option>
            <option>Учитель</option>
            <option>Админ</option>
        </select>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label" for="address">Address</label>
        <div class="col-md-4">
            <textarea class="form-control" id="description" name="address">default text</textarea>
        </div>
    </div>
@endsection
