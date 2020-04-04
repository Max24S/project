<template>
    <div>
        <form class="form-horizontal" role="form" id="form" @submit.prevent="sendUser" method="post">
            <h2>Добавление пользователя</h2>
            <div class="form-group">
                <div class="row">
                    <label for="firstName" class="col-sm-4 control-label">Фамилия</label>
                    <div class="col-sm-8 ">
                        <input
                            v-validate="'required|alpha'"
                            :class="{'input': true, 'alert-danger':errors.has('surname')}"
                            name="surname"
                            type="text"
                            id="firstName"
                            placeholder="Фамилия"
                            class="form-control"
                            v-model="user.surname"
                        >
                        <span v-show="errors.has('surname')" class="help is-danger">{{ errors.first('surname') }}</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="middleName" class="col-sm-4 control-label">Имя</label>
                    <div class="col-sm-8">
                        <input name="name"
                               type="text"
                               id="middleName"
                               placeholder="Имя"
                               class="form-control"
                               v-model="user.name"
                        >
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="lastName" class="col-sm-4 control-label">Отчество</label>
                    <div class="col-sm-8">
                        <input name="patronymic"
                               type="text"
                               id="lastName"
                               placeholder="Отчество"
                               class="form-control"
                               v-model="user.patronymic"
                        >
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="email" class="col-sm-4 control-label">Email </label>
                    <div class="col-sm-8">
                        <input name="email"
                               type="email"
                               id="email"
                               placeholder="Email"
                               class="form-control"
                               v-model="user.email"
                        >
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="birthDate" class="col-sm-4 control-label">Дата рождения</label>
                    <div class="col-sm-8">
                        <input name="birthday"
                               type="date"
                               id="birthDate"
                               class="form-control"
                               v-model="user.birthday"
                        >
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="phoneNumber" class="col-sm-4 control-label">Номер телефона</label>
                    <div class="col-sm-8">
                        <input
                            name="number"
                            type="phoneNumber"
                            id="phoneNumber"
                            placeholder="Номер телефона"
                            class="form-control"
                            v-model="user.number"
                        >
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label class="col-md-4 control-label" for="address">Адресс</label>
                    <div class="col-md-8">
                        <textarea
                            name="address"
                            class="form-control"
                            id="address"
                            placeholder="Адресс"
                            v-model="user.address"
                        >
                        </textarea>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label class="control-label col-sm-4">Укажите пол</label>
                    <div class="col-sm-8">
                        <label class="radio-inline mr-5">
                            <input
                                name='sex'
                                type="radio"
                                id="femaleRadio"
                                value="Женщина"
                                v-model="user.sex"
                            >
                            Женский
                        </label>
                        <label class="radio-inline">
                            <input
                                name='sex'
                                type="radio"
                                id="maleRadio"
                                value="Мужчина"
                                v-model="user.sex"
                            >
                            Мужской
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <label>Укажите роль</label>
                </div>
                <div class="form-group col-sm-6">
                    <select
                        name="role"
                        id="inputState"
                        class="form-control"
                        v-model="user.role"
                    >
                        <option selected></option>
                        <option>Директор</option>
                        <option>Завуч</option>
                        <option>Учитель</option>
                        <option>Ученик</option>
                    </select>
                </div>
            </div>

            <div class="row" v-if="user.role=='Ученик'">
                <div class="col-sm-4">
                    <label>Укажите класс</label>
                </div>
                <div class="form-group col-sm-6">
                    <select
                        name="grade_id"
                        id="selectGrade"
                        class="form-control"
                        v-model="user.grade"
                    >
                        <option selected></option>
                        <option value="1">11-a</option>
                        <option value="2">10-a</option>
                        <option>3</option>
                        <option>4</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Добавить</button>
        </form> <!-- /form -->
        <input v-validate="'required|email'" name="email" type="text">
        <span>{{ errors.first('email') }}</span>
        <a :href="classroomCreate">link</a>
    </div>
</template>

<script>
    import {AxiosInstance as axios} from "axios";

    export default {
        name: "CreateUser",

        data(){
            return {
                classroomCreate:window.routes['admin.super.classroom.create'],
                user:{
                    name:'',
                    surname:'',
                    patronymic:'',
                    email:'',
                    birthday:'',
                    number:'',
                    address:'',
                    sex:'',
                    role:'',
                    grade:''
                },
                email: '',

            }
        },
        methods: {
            sendUser(){
                //
                // let form = '#form';
                // axios.post(window.routes['admin.super.user.store'],this.user)
                //     .then((response)=>{
                //
                //         console.log(response);
                //
                //     })
            }
        }
    }
</script>

<style scoped>
 .is-danger {
     color: red;
 }
.alert-danger{
    border:2px solid red!important;
}
</style>
