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
                            v-model="grade.name"
                        >
                        <span v-show="errors.has('name')" class="help is-danger">{{ errors.first('name') }}</span>
                        <span v-if="nameDuplicate">Класс уже существует</span>
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
                            :options="this.classroomsAndTeachers.users"
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
                            :options="this.classroomsAndTeachers.classrooms"
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
        props:['classrooms-and-teachers'],
        created(){
          console.log(this.classroomsAndTeachers)
        },
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
                nameDuplicate:null,
                curatorDuplicate:null,
                classroomDuplicate:null
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
                                else if (response.data.response == 'duplicate') {

                                    this.nameDuplicate=response.data.name;
                                    this.curatorDuplicate=response.data.user_id;
                                    this.classroomDuplicate=response.data.classroom_id;

                                    this.$toaster.warning('Дубликаты');
                                }
                                else {

                                    this.$toaster.error('Ошибка');
                                }
                                console.log(response);

                            })
                            .catch(e => {
                                console.log(e);
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
    .is-danger {
        color: red;
    }
    .alert-danger{
        border:2px solid red!important;
    }
</style>
