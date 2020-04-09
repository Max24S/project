<template>
    <form class="form-horizontal" role="form" @submit.prevent="sendSubject">
        <h2>Добавление предмета</h2>
        <div class="form-group">
            <div class="row">
                <label for="Name" class="col-sm-4 control-label">Название предмета</label>
                <div class="col-sm-8">
                    <input
                        v-validate="'required'"
                        :class="{'input': true, 'alert-danger':errors.has('name')}"
                        type="text"
                        name="name"
                        id="Name"
                        placeholder="Предмет..."
                        class="form-control"
                        v-model="subject.name"
                    >
                    <span v-show="errors.has('name')" class="help is-danger">{{ errors.first('name') }}</span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-4">
                    <label>Преподаватели</label>
                </div>
                <div class="col-sm-8">
                    <v-select
                        v-model="subject.teachers"
                        :options="this.teachers"
                        :reduce="teacher => teacher.id"
                        label="fullName"
                        multiple
                    >
                    </v-select>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Добавить</button>
    </form>
</template>

<script>
    export default {
        name: "CreateSubject",
        props:['teachers'],
        data(){
            return {
                routes:{
                    subjectStore: window.routes['admin.super.subject.store']
                },
               subject:{
                   name:'',
                   teachers:''
               }
            }
        },
        created(){
            console.log(this.teachers);
        },
        methods: {
            sendSubject() {
                console.log(this.subject);
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        axios.post(this.routes.subjectStore, this.subject)
                            .then((response) => {
                                if (response.data.response == 'created') {

                                    this.$toaster.success('Предмет успешно добавлен');
                                }
                                else if (response.data.response == 'duplicate') {

                                    this.$toaster.warning('Предмет уже добавлен');
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
