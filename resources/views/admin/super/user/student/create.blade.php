@extends('admin.super.user.create')

@section('title')
    <h2>Добавление ученика</h2>
@endsection

@section('grade')
    <div class="row">
        <div class="col-sm-4">
            <label>Укажите класс</label>
        </div>
        <div class="form-group col-sm-6">
            <select id="selectGrade" class="form-control">
                <option selected></option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
            </select>
        </div>
    </div>
@endsection
