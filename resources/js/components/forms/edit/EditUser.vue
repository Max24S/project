<template>
    <div>
        <form class="form-horizontal" role="form" id="form" @submit.prevent="sendUser" method="post">
            <h2>Редактирование пользователя</h2>
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
                            v-model="editUser.surname"
                        >
                        <span v-show="errors.has('surname')" class="help is-danger">{{ errors.first('surname') }}</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="middleName" class="col-sm-4 control-label">Имя</label>
                    <div class="col-sm-8">
                        <input
                            v-validate="'required|alpha'"
                            :class="{'input': true, 'alert-danger':errors.has('name')}"
                            name="name"
                            type="text"
                            id="middleName"
                            placeholder="Имя"
                            class="form-control"
                            v-model="editUser.name"
                        >
                        <span v-show="errors.has('name')" class="help is-danger">{{ errors.first('name') }}</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="lastName" class="col-sm-4 control-label">Отчество</label>
                    <div class="col-sm-8">
                        <input
                            v-validate="'required|alpha'"
                            :class="{'input': true, 'alert-danger':errors.has('patronymic')}"
                            name="patronymic"
                            type="text"
                            id="lastName"
                            placeholder="Отчество"
                            class="form-control"
                            v-model="editUser.patronymic"
                        >
                        <span v-show="errors.has('patronymic')" class="help is-danger">{{ errors.first('patronymic') }}</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="email" class="col-sm-4 control-label">Email </label>
                    <div class="col-sm-8">
                        <input
                            v-validate="'required|email'"
                            :class="{'input': true, 'alert-danger':errors.has('email')}"
                            name="email"
                            type="email"
                            id="email"
                            placeholder="Email"
                            class="form-control"
                            v-model="editUser.email"
                        >
                        <span v-show="errors.has('email')" class="help is-danger">{{ errors.first('email') }}</span>
                    </div>

                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="birthDate" class="col-sm-4 control-label">Дата рождения</label>
                    <div class="col-sm-8">
                        <input
                            v-validate="'required'"
                            :class="{'input': true, 'alert-danger':errors.has('birthday')}"
                            name="birthday"
                            type="date"
                            id="birthDate"
                            class="form-control"
                            v-model="editUser.birthday"
                        >
                        <span v-show="errors.has('birthday')" class="help is-danger">Поле обязательно для заполнения</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="phoneNumber" class="col-sm-4 control-label">Номер телефона</label>
                    <div class="col-sm-8">
                        <input
                            v-validate="'required|numeric|min:9|max:12'"
                            :class="{'input': true, 'alert-danger':errors.has('number')}"
                            name="number"
                            type="phoneNumber"
                            id="phoneNumber"
                            placeholder="Номер телефона"
                            class="form-control"
                            v-model="editUser.number"
                        >
                        <span v-show="errors.has('number')" class="help is-danger">{{ errors.first('number') }}</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label class="col-md-4 control-label" for="address">Адресс</label>
                    <div class="col-md-8">
                        <textarea
                            v-validate="'required'"
                            :class="{'input': true, 'alert-danger':errors.has('address')}"
                            name="address"
                            class="form-control"
                            id="address"
                            placeholder="Адресс"
                            v-model="editUser.address"
                        >
                        </textarea>
                        <span v-show="errors.has('address')" class="help is-danger">{{ errors.first('address') }}</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label class="control-label col-sm-4">Укажите пол</label>
                    <div class="col-sm-8">
                        <label class="radio-inline mr-5">
                            <input
                                v-validate="'required'"
                                :class="{'input': true, 'alert-danger':errors.has('sex')}"
                                name='sex'
                                type="radio"
                                id="femaleRadio"
                                value="Женщина"
                                v-model="editUser.sex"
                            >
                            Женский
                        </label>
                        <label class="radio-inline">
                            <input
                                v-validate="'required'"
                                :class="{'input': true, 'alert-danger':errors.has('sex')}"
                                name='sex'
                                type="radio"
                                id="maleRadio"
                                value="Мужчина"
                                v-model="editUser.sex"
                            >
                            Мужской
                        </label>
                        <span v-show="errors.has('address')" class="help is-danger">{{ errors.first('sex') }}</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-4">
                        <label>Укажите роль</label>
                    </div>
                    <div class="form-group col-sm-8">
                        <select
                            v-validate="'excluded:none'"
                            :class="{'input': true, 'alert-danger':errors.has('role')}"
                            name="role"
                            id="inputState"
                            class="form-control"
                            v-model="editUser.role"
                        >
                            <option selected value="none"></option>
                            <option>Директор</option>
                            <option>Завуч</option>
                            <option>Учитель</option>
                            <option>Ученик</option>
                        </select>
                        <span v-show="errors.has('role')" class="help is-danger">{{ errors.first('role') }}</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row" v-if="editUser.role=='Ученик'">
                    <div class="col-sm-4">
                        <label>Укажите класс</label>
                    </div>
                    <div class="form-group col-sm-8">
                        <v-select
                            v-validate="'required'"
                            :class="{'input': true, 'alert-danger':errors.has('grade_id')}"
                            name="grade_id"
                            v-model="editUser.grade_id"
                            :options="studentData.grades"
                            :reduce="grade => grade.id"
                            label="name"
                        >
                        </v-select>
                        <span v-show="errors.has('grade_id')" class="help is-danger">{{ errors.first('grade_id') }}</span>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Добавить</button>
        </form> <!-- /form -->
    </div>
</template>

<script>
    export default {
        name: "EditUser",
        props:['user','student-data'],
        data(){
            return {
                routes:{
                    userUpdate: window.routes['admin.super']
                },
                editUser:{
                    name:'',
                    surname:'',
                    patronymic:'',
                    email:'',
                    birthday:'',
                    number:'',
                    address:'',
                    sex:'',
                    role:'',
                    grade_id:''
                },
            }
        },
        created(){

            this.editUser=this.user;
            this.editUser.grade_id=this.studentData.grade_id;
        },
        methods:{
        sendUser(){
            console.log(this.user);
            this.$validator.validateAll().then((result) => {
                if (result) {

                    axios.post('/admin/super/user/'+this.user.id,this.editUser)
                        .then((response)=>{
                            if(response.data.response == 'created'){

                                this.$toaster.success('Пользователь успешно добавлен');
                            }
                            else if(response.data.response == 'emailDuplicate'){

                                this.$toaster.warning('Пользователь с данным email уже существует');
                            }
                            else{

                                this.$toaster.error('Ошибка');
                            }
                            console.log(response);

                        })
                        .catch( e=>{

                            this.$toaster.error(e.response.data.message);
                        })

                }
                else {

                    this.$toaster.warning("Заполните все поля!");
                }
            })

        }
    }
    }
</script>

<style scoped>

</style>
