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
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-4">
                        <label>Руководитель</label>
                    </div>
                    <div class="col-sm-8">
                        <v-select
                            v-model="grade.user_id"
                            :options="options"
                            :reduce="teacher => teacher.id"
                            label="name"
                        >
                        </v-select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-4">
                        <label>Укажите кабинет</label>
                    </div>
                    <div class="form-group col-sm-8">
                        <v-select
                            v-model="grade.classroom_id"
                            :options="options"
                            :reduce="teacher => teacher.id"
                            label="name"
                        >
                        </v-select>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Добавить</button>
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
                selected:"",
                options: [
                    { id:1,name: 'Петров Степан Сидорович' },
                    { name: 'Jane',id:5 },
                    { name: 'Paul' ,id:6},
                    { name: 'Kate' ,id:7},
                    { name: 'Amanda',id:8 },
                    { name: 'Steve' ,id:9},
                    { id:15,name: 'Петров Степан Сидорович' },
                    { name: 'Jane',id:10},
                    { name: 'Paul' ,id:11},
                    { name: 'Kate' ,id:12},
                    { name: 'Amanda',id:13 },
                    { name: 'Steve' ,id:14},
                ],
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
