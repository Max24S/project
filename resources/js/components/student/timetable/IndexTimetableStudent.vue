<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform" xmlns="http://www.w3.org/1999/html">
    <div>
        <div class="container">
            <div class="form_container mx-auto">
                <form @submit.prevent="getTimetable">
                    <div class="row">
                        <div class="col-sm-4"><span class="title d-flex mb-4 justify-content-center">Укажите класс</span></div>
                        <div class="col-sm-4">  <v-select
                            v-model="grade.id"
                            :options="grades"
                            :reduce="grade => grade.id"
                            label="name"
                            class="mb-4"
                        >
                            <template v-slot:no-options="{ search, searching }">
                                <template v-if="searching">
                                    Совпадений не найдено
                                </template>
                            </template>
                            <template v-slot:no-options>
                                Нет элементов
                            </template>
                        </v-select></div>
                        <div class="col-sm-4"> <button type="submit" class="btn btn-primary btn-block">Выбрать</button></div>
                    </div>
                </form>
            </div>
        </div>
        <b-container fluid>
            <b-table
                show-empty
                small
                stacked="lg"
                :items="items"
                :fields="fields"
                :current-page="currentPage"
                :per-page="perPage"
                :filter="filter"
                :filterIncludedFields="filterOn"
                :sort-by.sync="sortBy"
                :sort-desc.sync="sortDesc"
                :sort-direction="sortDirection"
                @filtered="onFiltered"
                ref="table"
                bordered
                class="mb-0 table"
            >
                <template v-slot:thead-top="data">
                    <b-tr>
                        <b-th></b-th>
                        <b-th v-for="date in dateNow" :key="date.key">
                            <span class="d-flex justify-content-center">{{date}}</span>
                        </b-th>
                    </b-tr>
                </template>


                <template v-slot:cell()="row">
                    <span class="d-flex justify-content-center align-items-center">{{row.value.Lesson}}</span>
                    <span class="d-flex justify-content-center">{{row.value.subject}}</span>
                    <span class="d-flex justify-content-center"> {{ row.value.classroom}}</span>
                    <span class="d-flex justify-content-center">{{row.value.surname}} {{row.value.name}} {{row.value.patronymic}}</span>
                </template>

                <template v-slot:cell(actions)="row">
                    <a
                        class="btn btn-primary edit"
                        v-if="routes.Edit"
                        :href="routes.Edit+row.item.id+'/edit'"
                    >
                        Редактировать
                    </a>
                    <template v-if="action">
                        <a class="btn btn-info edit" :href="action.route+row.item.id+'/'+row.item.name">{{action.content}}</a>
                    </template>
                    <b-button
                        @click="showMsgBoxDelete(row.item.id,row.index)"
                        size="sm"
                        class="btn btn-danger">
                        Удалить
                    </b-button>
                </template>
            </b-table>
        </b-container>
    </div>
</template>

<script>
    export default {
        name:'TableAdmin',
        // props:['routes','fields','items','action','form-create'],
        props:['grades'],
        data() {
            return {
                grade:{
                    id:''
                },
                totalRows: 1,
                currentPage: 1,
                perPage: 10,
                pageOptions: [5, 10, 15],
                sortBy: '',
                sortDesc: false,
                sortDirection: 'asc',
                filter: null,
                filterOn: ['rrrrrrrrrrrr'],
                items:[
                    {lesson:{lesson:1},monday:{subject:"Математика",classroom:'2424',teacher:"Грибков Эдуард Петрович"},tuesday:{name:"life"},wednesday:"",thursday:"",friday:"",saturday:''},
                    {lesson:{lesson:2},monday:{name:"life"},tuesday:"",wednesday:"",thursday:"",friday:"",saturday:''},
                    {lesson:{lesson:3},monday:"",tuesday:{subject:"Математика",classroom:'2424',teacher:"Грибков Эдуард Петрович"},wednesday:"",thursday:"",friday:"",saturday:''},
                    {lesson:{lesson:4},monday:"",tuesday:"",wednesday:"",thursday:"",friday:"",saturday:''},
                    {lesson:{lesson:5},monday:"",tuesday:"",wednesday:{name:"life"},thursday:"",friday:"",saturday:''},
                    {lesson:{lesson:6},monday:"",tuesday:"",wednesday:"",thursday:{subject:"Математика",classroom:'2424',teacher:"Грибков Эдуард Петрович"},friday:"",saturday:''},
                    {lesson:{lesson:7},monday:"",tuesday:"",wednesday:"",thursday:"",friday:"",saturday:''},
                    {lesson:{lesson:8},monday:"",tuesday:"",wednesday:"",thursday:"",friday:{name:"life"},saturday:{subject:"Математика",classroom:'2424',teacher:"Грибков Эдуард Петрович"}}
                    ],
                fields:[
                    {key:'lesson',label:'№ Урока',class: 'text-center'},
                    {key:'monday',label: 'Понедельник',class: 'text-center'},
                    {key:'tuesday',label: 'Вторник',class: 'text-center'},
                    {key:'wednesday',label: 'Среда',class: 'text-center'},
                    {key:'thursday',label: 'Четверг',class: 'text-center'},
                    {key:'friday',label: 'Пятница',class: 'text-center'},
                    {key:'saturday',label: 'Суббота',class: 'text-center'},
                    ],
                routes:{},
                dateNow:[],
                days:['monday','tuesday','wednesday','thursday','friday','saturday']
            }
        },
        mounted() {
            console.log(this.$refs.table.items)
            this.totalRows = this.items.length
            console.log(this.grades)
            this.getNow();
        },
        methods: {
            getTimetable() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        axios.get('/student/timetable-index/'+this.grade.id, this.grade)
                            .then((response) => {
                                if (response.data.response == 'OK') {

                                    this.items=response.data.timetable;
                                    this.$toaster.success('Класс успешно добавлен');
                                    // document.location.href = "/admin/super/grade"
                                }
                                else if (response.data.response == 'duplicate') {

                                    this.$toaster.warning('Класс уже добавлен');
                                }
                                else {
                                    console.log(response)
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
            },
            getNow() {
               let nowDate = new Date();
               if(nowDate.getDay()){
                   nowDate.setDate(nowDate.getDate() - nowDate.getDay());
               }
                for(let i=1;i<7;i++){
                    let param =new Date(nowDate.setDate(nowDate.getDate()+1))

                    let day = param.getDate()<10?'0'+param.getDate():param.getDate();
                    let month = param.getMonth()+1<10?'0'+(param.getMonth()+1):param.getMonth()+1;
                    let year = param.getFullYear();

                    this.dateNow.push(day+"."+month+"."+year)
                }
            }
        },
    }
</script>

<style scoped>
    .form_container {
        padding: 25px;
        border:1px solid grey;
        margin-bottom:30px;
        border-radius:10px;
        max-width: 600px;
    }
    .title {
        font-size: 20px;
    }
    .is-danger {
        color: red;
    }
    .alert-danger{
        border:1px solid red!important;
    }
</style>
