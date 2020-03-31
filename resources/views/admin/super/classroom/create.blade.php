@extends('admin.super.layouts.admin')
@section('form')
    <form class="form-horizontal" method="POST" action="{{route('admin.super.classroom.store')}}">
    @csrf
        <h2>Добавление кабинета</h2>
        <div class="form-group">
            <div class="row">
                <label for="Name" class="col-sm-4 control-label">Номер кабинета</label>
                <div class="col-sm-8">
                    <input name="name" type="text" id="Name" placeholder="Кабинет..." class="form-control" autofocus>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Добавить</button>
    </form>
    @error('name')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
@endsection
