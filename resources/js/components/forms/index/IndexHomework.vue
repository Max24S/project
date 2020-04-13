<template>
    <div>
        <div class="container-fluid">
            <form method="get" @submit.prevent="SendData">
                <div class="form-container">
                    <div class="row">
                        <div class="col-5">
                            <select class="form-control input" v-model="timetableData.grade_id"  name="grade"
                                    v-validate="'required|excluded:none|integer'"
                                    :class="{'input': true, 'alert-danger':errors.has('grade')}">
                                <option value="none">Выберите класс</option>
                                <option v-for="grade in grades" :value="grade.id">{{grade.name}}</option>
                            </select>
                            <span v-if="errors.has('grade')" class="help is-danger">{{ errors.first('grade') }}</span>
                        </div>
                        <div class="col-5">
                            <select class="form-control input" v-model="timetableData.semester" name="semester"
                                    v-validate="'required|excluded:none|integer'"
                                    :class="{'input': true, 'alert-danger':errors.has('semester')}">
                                <option value="none">Выберите семестр</option>
                                <option >1</option>
                                <option>2</option>
                            </select>
                            <span v-if="errors.has('semester')" class="help is-danger">{{ errors.first('semester') }}</span>
                        </div>
                        <div class="col-2">
                            <b-button  variant="info" type="submit">Выбрать</b-button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
        <b-container fluid >
            <b-table
                    bordered
                    show-empty
                    small
                    stacked="md"
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
                    ref="table">
                <template v-slot:thead-top="data">
                    <b-tr>
                        <b-th></b-th>
                        <b-th v-for="date in dateForWeek['currentWeek']" :key="date.key">
                            <span class="d-flex justify-content-center">{{date}}</span>
                        </b-th>
                    </b-tr>
                </template>
                <template v-slot:empty="scope">
                    <span class="d-flex justify-content-center">Нет записей</span>
                </template>
                <template v-slot:cell(monday)="row">
                    <div class="d-flex justify-content-start">
<!--                        <b-button variant="danger" @click="deleleteLesson(row.value.id,row.index,'monday')" v-if="row.value.subject" class="mr-3"><b-icon-trash-fill></b-icon-trash-fill></b-button>-->
                        <b-button :disabled="(dateNow>dateForWeek['timestamp'][0])?true:false" v-if="row.value.subject" @click="OpenModal(dateForWeek['currentWeek'][0],'monday',row.item.lesson)" variant="primary"><b-icon-plus-square-fill></b-icon-plus-square-fill></b-button>
                    </div>
                        <div :class="(teacher[0].id==row.value.user_id)?'lesson':''">

                            <a :href="'/admin/teacher/head-teacher/timetable/'+row.value.id+'/edit'">
                                <span class="d-block text-center">{{row.value.subject}}</span>
                                <span class="d-block text-center">{{row.value.surname}} {{row.value.name}} {{row.value.patronymic}}</span>
                                <span class="d-block text-center">{{ row.value.classroom}}</span>
                            </a>
                        </div>
                </template>
                <template v-slot:cell(tuesday)="row">
                    <div class="d-flex justify-content-start">
<!--                        <b-button variant="danger" @click="deleleteLesson(row.value.id,row.index,'tuesday')" v-if="row.value.subject" class="mr-3"><b-icon-trash-fill></b-icon-trash-fill></b-button>-->
                        <b-button :disabled="(dateNow>dateForWeek['timestamp'][1])?true:false" v-if="row.value.subject" @click="OpenModal(dateForWeek['currentWeek'][1],'tuesday',row.item.lesson)" variant="primary"><b-icon-plus-square-fill></b-icon-plus-square-fill></b-button>
                    </div>
                    <div :class="(teacher[0].id==row.value.user_id)?'lesson':''">
                        <a :href="'/admin/teacher/head-teacher/timetable/'+row.value.id+'/edit'">
                            <span class="d-block text-center">{{row.value.subject}}</span>
                            <span class="d-block text-center">{{row.value.surname}} {{row.value.name}} {{row.value.patronymic}}</span>
                            <span class="d-block text-center">{{ row.value.classroom}}</span>
                        </a>
                    </div>
                </template>
                <template v-slot:cell(wednesday)="row">
                    <div class="d-flex justify-content-start">
<!--                        <b-button variant="danger" @click="deleleteLesson(row.value.id,row.index,'wednesday')" v-if="row.value.subject" class="mr-3"><b-icon-trash-fill></b-icon-trash-fill></b-button>-->
                        <b-button :disabled="(dateNow>dateForWeek['timestamp'][2])?true:false"  v-if="row.value.subject" @click="OpenModal(dateForWeek['currentWeek'][2],'wednesday',row.item.lesson)" variant="primary"><b-icon-plus-square-fill></b-icon-plus-square-fill></b-button>
                    </div>
                    <div :class="(teacher[0].id==row.value.user_id)?'lesson':''">
                        <a :href="'/admin/teacher/head-teacher/timetable/'+row.value.id+'/edit'">
                            <span class="d-block text-center">{{row.value.subject}}</span>
                            <span class="d-block text-center">{{row.value.surname}} {{row.value.name}} {{row.value.patronymic}}</span>
                            <span class="d-block text-center">{{ row.value.classroom}}</span>
                        </a>
                    </div>
                </template>
                <template  v-slot:cell(thursday)="row">
                    <div class="d-flex justify-content-start">
<!--                        <b-button  variant="danger" @click="deleleteLesson(row.value.id,row.index,'thursday')" v-if="row.value.subject" class="mr-3"><b-icon-trash-fill></b-icon-trash-fill></b-button>-->
                        <b-button :disabled="(dateNow>dateForWeek['timestamp'][3])?true:false" v-if="row.value.subject" @click="OpenModal(dateForWeek['currentWeek'][3],'thursday',row.item.lesson)" variant="primary"><b-icon-plus-square-fill></b-icon-plus-square-fill></b-button>
                    </div>
                    <div :class="(teacher[0].id==row.value.user_id)?'lesson':''">
                        <a :href="'/admin/teacher/head-teacher/timetable/'+row.value.id+'/edit'">
                            <span class="d-block text-center">{{row.value.subject}}</span>
                            <span class="d-block text-center">{{row.value.surname}} {{row.value.name}} {{row.value.patronymic}}</span>
                            <span class="d-block text-center">{{ row.value.classroom}}</span>
                        </a>
                    </div>
                </template>
                <template  v-slot:cell(friday)="row">
                    <div class="d-flex justify-content-start">
<!--                        <b-button  variant="danger"@click="deleleteLesson(row.value.id,row.index,'friday')" v-if="row.value.subject" class="mr-3"><b-icon-trash-fill></b-icon-trash-fill></b-button>-->
                        <b-button :disabled="(dateNow>dateForWeek['timestamp'][4])?true:false" v-if="row.value.subject" @click="OpenModal(dateForWeek['currentWeek'][4],'friday',row.item.lesson)" variant="primary"><b-icon-plus-square-fill></b-icon-plus-square-fill></b-button>
                    </div>
                    <div :class="(teacher[0].id==row.value.user_id)?'lesson':''">
                        <a :href="'/admin/teacher/head-teacher/timetable/'+row.value.id+'/edit'">
                            <span class="d-block text-center">{{row.value.subject}}</span>
                            <span class="d-block text-center">{{row.value.surname}} {{row.value.name}} {{row.value.patronymic}}</span>
                            <span class="d-block text-center">{{ row.value.classroom}}</span>
                        </a>
                    </div>
                </template>
                <template  v-slot:cell(saturday)="row">
                    <div class="d-flex justify-content-start">
<!--                        <b-button variant="danger" @click="deleleteLesson(row.value.id,row.index,'saturday')" v-if="row.value.subject" class="mr-3"><b-icon-trash-fill></b-icon-trash-fill></b-button>-->
                        <b-button :disabled="(dateNow>dateForWeek['timestamp'][5])?true:false"  v-if="row.value.subject" @click="OpenModal(dateForWeek['currentWeek'][5],'saturday',row.item.lessonph)" variant="primary"><b-icon-plus-square-fill></b-icon-plus-square-fill></b-button>
                    </div>
                    <div :class="(teacher[0].id==row.value.user_id)?'lesson':''">
                        <a :href="'/admin/teacher/head-teacher/timetable/'+row.value.id+'/edit'">
                            <span class="d-block text-center">{{row.value.subject}}</span>
                            <span class="d-block text-center">{{row.value.surname}} {{row.value.name}} {{row.value.patronymic}}</span>
                            <span class="d-block text-center">{{ row.value.classroom}}</span>
                        </a>
                    </div>
                </template>
            </b-table>
        </b-container>
        {{show}}
        <div>
            <add-homework @hide="show=$event"
                        :timetable="timetableData"
                        :id="teacher"
                        :visible="show">
            </add-homework>
        </div>
    </div>
</template>

<script>
    export default {
    name: "IndexHomework",
    props:['grades'],
     data(){
        return {
            timetableData:
                {   lesson:'',
                    grade_id:'none',
                    semester:'none',
                    rowDay:''
                },
            request:{},

            items:[],
            lesson: {

            },
            isVisible:"",
            fields: [
                { key: 'lesson', label: '№ урока' ,class: 'text-center'},
                { key: 'monday', label: 'Понедельник' ,class: 'text-center'},
                { key: 'tuesday', label: 'Вторник' ,class: 'text-center'},
                { key: 'wednesday', label: 'Среда' ,class: 'text-center'},
                { key: 'thursday', label: 'Четверг' ,class: 'text-center'},
                { key: 'friday', label: 'Пятница' ,class: 'text-center'},
                { key: 'saturday', label: 'Суббота' ,class: 'text-center'},
            ],
            totalRows: 1,
            currentPage: 1,
            perPage: 8,
            sortBy: '',
            sortDesc: false,
            sortDirection: 'asc',
            filter: null,
            filterOn: [],
            infoModal: {
                id: 'info-modal',
                title: '',
                content: ''
            },

            teacher:'',
            show:false,
            showCell:true,
            lastMeaningGrade:"",
            lastMeaningSemester:"",
            activeBtn:false,
            dateNow:'',
            dateForWeek:{},
            days:['monday','tuesday','wednesday','thursday','friday','saturday']
        }
     },
        methods:{
            info(item, index, button) {
                this.infoModal.title = `Row index: ${index}`
                this.infoModal.content = JSON.stringify(item, null, 2)
                this.$root.$emit('bv::show::modal', this.infoModal.id, button)
            },
            resetInfoModal() {
                this.infoModal.title = ''
                this.infoModal.content = ''
            },
            onFiltered(filteredItems) {
                this.totalRows = filteredItems.length
                this.currentPage = 1
            },
            OpenModal: function (date,rowDay,number) {
                this.timetableData.rowDay=rowDay;
                this.timetableData.date=date;
                this.timetableData.lesson=number;
                this.show=true;
            },
            SendData(){
                this.$validator.validateAll().then((result) => {
                    if (result) {

                        if(this.timetableData['grade_id']==this.lastMeaningGrade&&this.timetableData['semester']==this.lastMeaningSemester)
                        {
                            this.$toaster.info('Вы уже выбрали расписание для этого класса', {timeout: 5000})
                        }
                        else {
                            this.lastMeaningGrade=this.timetableData['grade_id'];
                            this.lastMeaningSemester=this.timetableData['semester'];
                            axios.post('/admin/teacher/homework/indexTimetable', this.timetableData)
                                .then((response) => {
                                    if (response.data.result=='OK') {
                                        this.items=response.data['timetable'];
                                        this.teacher=response.data['teacher'];
                                        this.isVisible=1;
                                    }
                                })
                                .catch(e => {
                                    this.$toaster.error(e.response.data.message);
                                })
                        }
                    }
                    else{
                        this.$toaster.warning('Будьте внимательны при заполнении полей', {timeout: 5000})
                    }
                })
            },
            getNow() {

                let currentWeek=[];
                let timestamp=[];
                let nowDate = new Date();

                for(let i=1;i<7;i++){
                    let param =new Date(nowDate.setDate(nowDate.getDate()+1))
                    let day = param.getDate()<10?'0'+param.getDate():param.getDate();
                    let month = param.getMonth()+1<10?'0'+(param.getMonth()+1):param.getMonth()+1;
                    let year = param.getFullYear();
                    timestamp.push(+new Date(param));
                    currentWeek.push(day+"."+month+"."+year)
                }
                return {'currentWeek':currentWeek,'timestamp':timestamp};
                }
        }
        ,computed:{
            sortOptions() {
                return this.fields
                    .filter(f => f.sortable)
                    .map(f => {
                        return { text: f.label, value: f.key }
                    })
            }
        },
        mounted() {
            this.totalRows = this.items.length

            this.totalRows = this.items.length

            this.getNow();
        },
        created() {
            this.dateForWeek=this.getNow();
            console.log(this.dateForWeek);
            this.dateNow=+new Date();
            console.log(this.dateNow);

            // this.timetableData['grade_id']=(this.params['grade'])?this.params['grade']:"none";
            // this.timetableData['semester']=(this.params['semester'])?this.params['semester']:"none"
            if (this.timetableData['grade_id']!='none'&&this.timetableData['semester']!='none')
            {
                this.SendData();
            }
        }
    }
</script>

<style scoped>
    .disabled{

    }
    form {
        margin-top:53px;
    }
    .btn .b-icon.bi{
        font-size: 80%;
    }
    .active{
        color: blue;
    }
    .is-danger {
        color: #ff0000;
    }
    .alert-danger{
        border:2px solid #ff0000;
    }
    table a{
        text-decoration: none;
    }
    .lesson{
        border:1px dashed darkslategrey;
    }
    .form-container {
        max-width:700px;
    }
</style>