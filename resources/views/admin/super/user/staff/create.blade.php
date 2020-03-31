@extends('admin.super.user.create')
@section('route')
    action="{{route('admin.super.staff.store')}}"
    @endsection
@section('title')
    <h2>Добавление сотрудника</h2>
@endsection

@section('staff')
    <div class="row">
        <div class="col-sm-4">
            <label>Укажите роль</label>
        </div>
        <div class="form-group col-sm-6">
            <select name="role" id="inputState" class="form-control">
                <option selected></option>
                <option>Директор</option>
                <option>Завуч</option>
                <option>Учитель</option>
                <option>Админ</option>
            </select>
        </div>
    </div>
@endsection
