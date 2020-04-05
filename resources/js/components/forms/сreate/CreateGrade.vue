<template>
    <div>
        <form class="form-horizontal" role="form" @submit.prevent = "sendGrade">
            <h2>Добавление класса</h2>
            <div class="form-group">
                <div class="row">
                    <label for="Name" class="col-sm-4 control-label">Название класса</label>
                    <div class="col-sm-8">
                        <input
                            v-validate="'required'"
                            :class="{'input': true, 'alert-danger':errors.has('name')}"
                            type="text"
                            name="name"
                            id="Name"
                            placeholder="Класс..."
                            class="form-control"
                        >
                        <span v-show="errors.has('name')" class="help is-danger">{{ errors.first('name') }}</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <label>Укажите руководителя</label>
                </div>
                <div class="form-group col-sm-6">

                    <div class="row">
                        <div class="search-wrapper panel-heading col-sm-12">
                            <input class="form-control" type="text" v-model="searchQuery" placeholder="Search" />
                        </div>
                    </div>
                    <select  size="6" v-model="test1">
                        <option v-for="item in resultQuery" :value="item">{{item.name}}</option>
                    </select>
                    <v-select></v-select>
                    <select class="mdb-select md-form colorful-select dropdown-primary" multiple searchable="Search here..">
                        <option value="" disabled selected>Choose your country</option>
                        <option v-for="item in resultQuery" :value="item">{{item.name}}</option>

                    </select>
                    <table v-if="selectetTeacher" class="table">
                        <thead>
                        <tr>
                            <th>Выбран</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{selectetTeacher.name}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--<div class="row">-->
                <!--<div class="col-sm-4">-->
                    <!--<label>Укажите кабинет</label>-->
                <!--</div>-->
                <!--<div class="form-group col-sm-6">-->
                    <!--<select id="inputClassroom" class="form-control">-->
                        <!--<option selected></option>-->
                    <!--</select>-->
                <!--</div>-->
            <!--</div>-->
            <!--&lt;!&ndash;<button type="submit" class="btn btn-primary btn-block">Добавить</button>&ndash;&gt;-->

            
        </form>
    </div>
</template>



<script>

    export default {
        name: "CreateGrade",
        data(){
            return {
                routes:{
                    gradeStore: window.routes['admin.super.grade.store']
                },
                grade:{
                    name:'',
                    user_id:'',
                    classroom_id:'',
                },
                words:['spray', 'limit', 'elite', 'exuberant', 'destruction', 'present'],
                test:'',
                test1:'',

                users: [
                    { name: 'Петров Степан Сидорович', age: 50,id:1 },
                    { name: 'Петров Степан Сидорович', age: 50,id:2 },
                    { name: 'Петров Степан Сидорович', age: 50,id:3 },
                    { name: 'Петров Степан Сидорович', age: 50,id:4 },
                    { name: 'Jane', age: 22 ,id:5 },
                    { name: 'Paul', age: 34 ,id:6},
                    { name: 'Kate', age: 15 ,id:7},
                    { name: 'Amanda', age: 65,id:8 },
                    { name: 'Steve', age: 38 ,id:9},

                ],
                searchQuery: null,
                selected:[]
            }
        },
        methods: {
            sendGrade() {
                console.log(this.grade);
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        axios.post(this.routes.gradeStore, this.grade)
                            .then((response) => {
                                if (response.data.response == 'created') {

                                    this.$toaster.success('Класс успешно добавлен');
                                }
                                else if (response.data.response == 'emailDuplicate') {

                                    this.$toaster.warning('Пользователь с данным email уже существует');
                                }
                                else {

                                    this.$toaster.error('Ошибка');
                                }
                                console.log(response);

                            })
                            .catch(e => {

                                this.$toaster.error(e.response.data.message);
                            })

                    }
                    else {

                        this.$toaster.warning("Заполните все поля!");
                    }
                })

            }
        },
        computed: {
            resultQuery(){
                if(this.searchQuery){
                    return this.users.filter((item)=>{
                        return this.searchQuery.toLowerCase().split(' ').every(v => item.name.toLowerCase().includes(v))
                    })
                }else{
                    return this.users;
                }
            },
            selectetTeacher(){
                if(this.test1){

                   this.searchQuery = this.test1;
                }
            }
            // selectetTeachers(){
            //
            //
            //     if(this.selected.indexOf(this.test1)==-1&&this.test1){
            //
            //         this.selected.push(this.test1);
            //     }
            //     console.log(this.selected.length)
            //     return this.selected;
            // }
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
