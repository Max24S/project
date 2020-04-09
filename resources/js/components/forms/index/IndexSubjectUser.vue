<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform" xmlns="http://www.w3.org/1999/html">
    <div>
        <div class="container-fluid">
            <span class="title d-block mb-3">{{subject.name}}</span>
            <div class="row">
                <div class="col-sm-4">
                    <label>Добавление преподавателя</label>
                </div>
                <div class="col-sm-8">
                    <div class="row">
                        <div class="col-6">
                            <v-select
                                v-model="createRequest.user_id"
                                :options="teachers.teachers"
                                :reduce="teacher => teacher.id"
                                label="fullName"
                            >
                            </v-select>
                        </div>
                        <div class="col-6">
                            <button @click="addTeachers()" class="btn btn-primary btn-block">Добавить</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <table-admin :items="teachers.teachersForSubjects" :fields="fields" :routes="routes"></table-admin>
    </div>
</template>

<script>
    export default {
        props:['subject','teachers'],
        created(){
            console.log(this.teachers)
        },
        data() {
            return {
                routes:{
                    Create:'',
                    Edit:'',
                    Delete:'/admin/super/subject-user/'
                },
                fields: [
                    { key: 'id',label: 'id', sortable: true,sortDirection: 'desc', class: 'text-center' },
                    { key: 'name', label: 'Имя', sortable: true,sortDirection: 'desc', class: 'text-center' },
                    { key: 'surname', label: 'фамилия', sortable: true, sortDirection: 'desc' ,class: 'text-center'},
                    { key: 'patronymic', label: 'Отчество', sortable: true, sortDirection: 'desc',class: 'text-center' },
                    { key: 'actions', label: 'Действия' }
                ],
                createRequest:{
                    subject_id:this.subject.id,
                    user_id:''
                }
            }
        },
        methods: {
            addTeachers() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        axios.post('/admin/super/subject-user', this.createRequest)
                            .then((response) => {
                                if (response.data.response == 'created') {

                                    this.$toaster.success('Запись успешно добавлена');
                                }
                                else if (response.data.response == 'duplicate') {

                                    this.$toaster.warning('Запись уже существует');
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
    .title {
        font-size:22px;
    }
</style>
