<template>
    <div>
        <form class="form-horizontal" role="form" @submit.prevent = "sendGrade">
            <!--<h2>Добавление класса</h2>-->
            <!--<div class="form-group">-->
                <!--<div class="row">-->
                    <!--<label for="Name" class="col-sm-4 control-label">Название класса</label>-->
                    <!--<div class="col-sm-8">-->
                        <!--<input type="text" id="Name" placeholder="Класс..." class="form-control" autofocus>-->
                    <!--</div>-->
                <!--</div>-->
            <!--</div>-->
            <!--<div class="row">-->
                <!--<div class="col-sm-4">-->
                    <!--<label>Укажите руководителя</label>-->
                <!--</div>-->
                <!--<div class="form-group col-sm-6">-->
                    <!--<select id="inputStaff" class="form-control">-->
                        <!--<option selected></option>-->
                    <!--</select>-->
                <!--</div>-->
            <!--</div>-->
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
            <!--<button type="submit" class="btn btn-primary btn-block">Добавить</button>-->
            <div class="row">
                <div class="search-wrapper panel-heading col-sm-12">
                    <input class="form-control" type="text" v-model="searchQuery" placeholder="Search" />
                </div>
            </div>
            <select  size="6" v-model="test1">
                <option v-for="item in resultQuery">{{item.name}}</option>
            </select>
            <ul>
                <li v-for="item in selectetTeachers">{{item}}</li>
            </ul>
            <input type="text" v-model="test">
            <table v-if="users.length" class="table">
                <thead>
                <tr>
                    <th>Resource</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in resultQuery">
                    <td><a  target="_blank">{{item.name}}</a></td>
                </tr>
                </tbody>
            </table>
            
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
                test:' ',
                test1:'',

                users: [
                    { name: 'Петров Степан Сидорович', age: 50 },
                    { name: 'Петров Степан Сидорович', age: 50 },
                    { name: 'Петров Степан Сидорович', age: 50 },
                    { name: 'Петров Степан Сидорович', age: 50 },
                    { name: 'Jane', age: 22 },
                    { name: 'Paul', age: 34 },
                    { name: 'Kate', age: 15 },
                    { name: 'Amanda', age: 65 },
                    { name: 'Steve', age: 38 },
                    { name: 'Keith', age: 21 },
                    { name: 'Don', age: 50 },
                    { name: 'Susan', age: 21 }
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
            selectetTeachers(){
               this.selected.push(this.test1)

                return this.selected;
            }
        }
    }
</script>

<style scoped>

</style>
