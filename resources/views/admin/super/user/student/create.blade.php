@extends('admin.super.user.create')

@section('route')
    action="{{route('admin.super.student.store')}}"
@endsection

@section('title')
    <h2>Добавление ученика</h2>
@endsection

@section('grade')
    <input type='hidden' value="Ученик" name = 'role'>
    <div class="row">
        <div class="col-sm-4">
            <label>Укажите класс</label>
        </div>
        <div class="form-group col-sm-6">
            <select name="grade_id" id="selectGrade" class="form-control">
                <option selected></option>
                <option value="1">11-a</option>
                <option value="2">10-a</option>
                <option>3</option>
                <option>4</option>
            </select>
        </div>
    </div>
@endsection
