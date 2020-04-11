<template>
    <form class="form-horizontal" role="form" @submit.prevent="sendSubject">
        <div class="form-group">
            <div class="row">
                <div class="col-sm-4">
                    <label>Добавление преподавателя</label>
                </div>
                <div class="col-sm-8">
                    <v-select
                        v-validate="'required'"
                        :class="{'input': true, 'alert-danger':errors.has('name')}"
                        name="name"
                        v-model="teacher.user_id"
                        :options="teachers"
                        :reduce="teacher => teacher.id"
                        label="fullName"
                    >
                    </v-select>
                    <span v-show="errors.has('name')" class="help is-danger">{{ errors.first('name') }}</span>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Добавить</button>
    </form>
</template>

<script>
    export default {
        name: "CreateUserSubject",
        props:['teachers','id'],
        data(){
            return {
                teacher:{
                    user_id:'',
                    subject_id:this.id
                }
            }
        },
        created(){
            console.log(this.teachers);
        },
        methods: {
            sendSubject() {
                console.log(this.teacher);
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        axios.post('/admin/super/subject-user', this.teacher)
                            .then((response) => {
                                if (response.data.response == 'created') {

                                    this.$toaster.success('Преподаватель успешно добавлен');
                                }
                                else if (response.data.response == 'duplicate') {

                                    this.$toaster.warning('Преподаватель уже добавлен');
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
