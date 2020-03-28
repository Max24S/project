@extends('admin.layouts.admin')
@section('form')
    @php($role='staff')
<div class="container">
    <form class="form-horizontal" role="form">
        <h2>
            @if($role=='student')
                Добавление ученика
            @elseif($role=='staff')
                Добавление персонала
            @endif
        </h2>
        <div class="form-group">
            <label for="firstName" class="col-sm-3 control-label">Фамилия</label>
            <div class="col-sm-9 ">
                <input type="text" id="firstName" placeholder="Фамилия" class="form-control" autofocus>
            </div>
        </div>
        <div class="form-group">
            <label for="middleName" class="col-sm-3 control-label">Имя</label>
            <div class="col-sm-9">
                <input type="text" id="middleName" placeholder="Имя" class="form-control" autofocus>
            </div>
        </div>
        <div class="form-group">
            <label for="lastName" class="col-sm-3 control-label">Отчество</label>
            <div class="col-sm-9">
                <input type="text" id="lastName" placeholder="Отчество" class="form-control" autofocus>
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-3 control-label">Email </label>
            <div class="col-sm-9">
                <input type="email" id="email" placeholder="Email" class="form-control" name= "email">
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-3 control-label">Password</label>
            <div class="col-sm-9">
                <input type="password" id="password" placeholder="Password" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-3 control-label">Confirm Password</label>
            <div class="col-sm-9">
                <input type="password" id="password" placeholder="Password" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label for="birthDate" class="col-sm-3 control-label">Date of Birth</label>
            <div class="col-sm-9">
                <input type="date" id="birthDate" class="form-control">
            </div>
        </div>
        @if($role=='student')
        <div class="form-group col-md-6">
            <select id="inputState" class="form-control">
                <option selected>Класс</option>
                <option>1</option>
            </select>
        </div>
        @endif
        <div class="form-group">
            <label for="phoneNumber" class="col-sm-3 control-label">Phone number </label>
            <div class="col-sm-9">
                <input type="phoneNumber" id="phoneNumber" placeholder="Phone number" class="form-control">
                <span class="help-block">Your phone number won't be disclosed anywhere </span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="address">Address</label>
            <div class="col-md-4">
                <textarea class="form-control" id="address" name="address">default text</textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3">Gender</label>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-4">
                        <label class="radio-inline">
                            <input name='sex' type="radio" id="femaleRadio" value="Female">Female
                        </label>
                    </div>
                    <div class="col-sm-4">
                        <label class="radio-inline">
                            <input name='sex' type="radio" id="maleRadio" value="Male">Male
                        </label>
                    </div>
                </div>
            </div>
            @if($role=='staff')
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
             @endif
        </div> <!-- /.form-group -->
        <button type="submit" class="btn btn-primary btn-block">Register</button>
    </form> <!-- /form -->
</div> <!-- ./container -->
@endsection
