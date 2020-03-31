@extends('admin.super.layouts.admin')
<style>
    textarea {
        height: 80px!important;
        resize: none!important;
    }
</style>
@section('form')
            <form class="form-horizontal" role="form">
                @yield('title')
                <div class="form-group">
                    <div class="row">
                        <label for="firstName" class="col-sm-4 control-label">Фамилия</label>
                        <div class="col-sm-8 ">
                            <input name="surname" type="text" id="firstName" placeholder="Фамилия" class="form-control" autofocus>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="middleName" class="col-sm-4 control-label">Имя</label>
                        <div class="col-sm-8">
                            <input name="name" type="text" id="middleName" placeholder="Имя" class="form-control" autofocus>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="lastName" class="col-sm-4 control-label">Отчество</label>
                        <div class="col-sm-8">
                            <input name="patronymic" type="text" id="lastName" placeholder="Отчество" class="form-control" autofocus>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="email" class="col-sm-4 control-label">Email </label>
                        <div class="col-sm-8">
                            <input name="email" type="email" id="email" placeholder="Email" class="form-control" name= "email">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="birthDate" class="col-sm-4 control-label">Дата рождения</label>
                        <div class="col-sm-8">
                            <input name="" type="date" id="birthDate" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="phoneNumber" class="col-sm-4 control-label">Номер телефона</label>
                        <div class="col-sm-8">
                            <input name="number" type="phoneNumber" id="phoneNumber" placeholder="Номер телефона" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-md-4 control-label" for="address">Адресс</label>
                        <div class="col-md-8">
                            <textarea name="address" class="form-control" id="address" name="address" placeholder="Адресс"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="control-label col-sm-4">Укажите пол</label>
                            <div class="col-sm-8">
                                <label class="radio-inline mr-5">
                                    <input name='sex' type="radio" id="femaleRadio" value="Female">Женский
                                </label>
                                <label class="radio-inline">
                                    <input name='sex' type="radio" id="maleRadio" value="Male">Мужской
                                </label>
                            </div>
                    </div>
                </div> <!-- /.form-group -->

                @yield('grade')

                @yield('staff')

                <button type="submit" class="btn btn-primary btn-block">Добавить</button>
            </form> <!-- /form -->
@endsection
