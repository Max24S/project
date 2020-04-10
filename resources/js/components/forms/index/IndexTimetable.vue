<template>
    <div>
        <div class="container-fluid">
            <form method="get" @submit.prevent="SendData">
                <div class="form-container">
                    <div class="row">
                        <div class="col-5">
                            <select class="form-control input" v-model="timetableData.grade_id"  name="grade">
                                <option value="none">Выберите класс</option>
                                <option v-for="grade in teachersAndSubjects['grades']" :value="grade.id">{{grade.name}}</option>
                            </select>
                        </div>
                        <div class="col-5">
                            <select class="form-control input" v-model="timetableData.semester" name="semester">
                                <option value="none">Выберите семестр</option>
                                <option selected>1</option>
                                <option>2</option>
                            </select>
                        </div>
                        <div class="col-2">
                           <b-button variant="info" type="submit">Выбрать</b-button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    <b-container fluid >
        <!-- User Interface controls -->
        <!-- Main table element -->
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
            <template v-slot:cell(monday)="row">
                <b-button variant="danger" @click="deleleteLesson(row.value.id,row.index,'monday')" v-if="row.value.subject" class="mr-3"><b-icon-trash-fill></b-icon-trash-fill></b-button>
                <a :href="'timetable/'+row.value.id+'/edit'"><span class="d-block text-center">{{row.value.subject}}</span><span class="d-block text-center">{{ row.value.classroom}}</span></a>
                <b-button v-if="!row.value.subject" @click="OpenModal('Понедельник',row.item.lesson,'monday')" variant="primary"><b-icon-plus-square-fill></b-icon-plus-square-fill></b-button>

            </template>
            <template v-slot:cell(tuesday)="row">
                    <b-button variant="danger" @click="deleleteLesson(row.value.id,row.index,'tuesday')" v-if="row.value.subject" class="mr-3"><b-icon-trash-fill></b-icon-trash-fill></b-button>
                <a :href="'timetable/'+row.value.id+'/edit'"><span class="d-block text-center">{{row.value.subject}}</span><span class="d-block text-center">{{ row.value.classroom}}</span></a>
                    <b-button  v-if="!row.value.subject" @click="OpenModal('Вторник',row.item.lesson,'tuesday')" variant="primary"><b-icon-plus-square-fill></b-icon-plus-square-fill></b-button>
            </template>
            <template v-slot:cell(wednesday)="row">
                <b-button variant="danger" @click="deleleteLesson(row.value.id,row.index,'wednesday')" v-if="row.value.subject" class="mr-3"><b-icon-trash-fill></b-icon-trash-fill></b-button>
                <a :href="'timetable/'+row.value.id+'/edit'"><span class="d-block text-center">{{row.value.subject}}</span><span class="d-block text-center">{{ row.value.classroom}}</span></a>
                <b-button  v-if="!row.value.subject" @click="OpenModal('Среда',row.item.lesson,'wednesday')" variant="primary"><b-icon-plus-square-fill></b-icon-plus-square-fill></b-button>
            </template>
            <template  v-slot:cell(thursday)="row">
                <b-button  variant="danger" @click="deleleteLesson(row.value.id,row.index,'thursday')" v-if="row.value.subject" class="mr-3"><b-icon-trash-fill></b-icon-trash-fill></b-button>
                <a :href="'timetable/'+row.value.id+'/edit'"><span class="d-block text-center">{{row.value.subject}}</span><span class="d-block text-center">{{ row.value.classroom}}</span></a>
                <b-button  v-if="!row.value.subject" @click="OpenModal('Четверг',row.item.lesson,'thursday')" variant="primary"><b-icon-plus-square-fill></b-icon-plus-square-fill></b-button>
            </template>
            <template  v-slot:cell(friday)="row">
                <b-button  variant="danger"@click="deleleteLesson(row.value.id,row.index,'friday')" v-if="row.value.subject" class="mr-3"><b-icon-trash-fill></b-icon-trash-fill></b-button>
                <a :href="'timetable/'+row.value.id+'/edit'"><span class="d-block text-center">{{row.value.subject}}</span><span class="d-block text-center">{{ row.value.classroom}}</span></a>
                <b-button v-if="!row.value.subject" @click="OpenModal('Пятница',row.item.lesson,'friday')" variant="primary"><b-icon-plus-square-fill></b-icon-plus-square-fill></b-button>
            </template>
            <template  v-slot:cell(saturday)="row">
                <b-button variant="danger" @click="deleleteLesson(row.value.id,row.index,'saturday')" v-if="row.value.subject" class="mr-3"><b-icon-trash-fill></b-icon-trash-fill></b-button>
                <a :href="'timetable/'+row.value.id+'/edit'"><span class="d-block text-center">{{row.value.subject}}</span><span class="d-block text-center">{{ row.value.classroom}}</span></a>
                <b-button v-if="!row.value.subject" @click="OpenModal('Суббота',row.item.lesson,'saturday')" variant="primary"><b-icon-plus-square-fill></b-icon-plus-square-fill></b-button>
            </template>
            <template v-slot:cell(actions)="row">
                <b-button  size="sm" @click="info(row.item, row.index, $event.target)" class="mr-1">
                    Info modal
                </b-button>
                <b-button size="sm" @click="row.toggleDetails">
                    {{ row.detailsShowing ? 'Hide' : 'Show' }} Details
                </b-button>
            </template>
            <template v-slot:row-details="row">
                <b-card>
                    <ul>
                        <li v-for="(value, key) in row.item" :key="key">{{ key }}: {{ value }}</li>
                    </ul>
                </b-card>
            </template>
        </b-table>
        <b-modal :id="infoModal.id" :title="infoModal.title" ok-only @hide="resetInfoModal">
            <pre>{{ infoModal.content }}</pre>
        </b-modal>
    </b-container>
        <div>
            <add-lesson @hide="show=$event" :teachers-and-subjects="teachersAndSubjects"
                        :timetable="timetableData"
                        :visible="show"
                        @lesson="RefreshTimetable($event)"
            ></add-lesson>
        </div>
    </div>
</template>
<script>

    export default {
        name: "IndexTimetable",
        props:['teachers-and-subjects'],
        data(){
            return {
                timetableData:
                    {   lesson:'',
                        grade_id:'none',
                        day:'',
                        semester:'none',
                        rowDay:''
                    },
                counter:1,
                request:{},
                items:[],
                lesson: {
                },
                isVisible:"",
                fields: [
                    { key: 'lesson', label: '№ урока' },
                    { key: 'monday', label: 'Понедельник' },
                    { key: 'tuesday', label: 'Вторник' },
                    { key: 'wednesday', label: 'Среда' },
                    { key: 'thursday', label: 'Четверг' },
                    { key: 'friday', label: 'Пятница' },
                    { key: 'saturday', label: 'Суббота' },
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
                show:false,
                showCell:true
            }
        },
        methods:{
            RefreshTimetable(lesson)
            {
                this.items[lesson.lesson-1][lesson.dayRow]={
                    'id':lesson.id,
                    'classroom':lesson.classroom,
                    'subject':lesson.subject
                };
                this.$refs.table.refresh();
                console.log( this.items[lesson.lesson-1][lesson.dayRow]);
            },
            SendData(){
                this.$validator.validateAll().then((result) => {
                    if (true) {
                        axios.post(window.routes['admin.teacher.head-teacher.timetable.indexTimetable'], this.timetableData)
                            .then((response) => {
                                if (response.data.result=='OK') {
                                    this.items=response.data.timetable;
                                    this.isVisible=1;
                                    console.log(this.items);
                                }
                            })
                            .catch(e => {
                                this.$toaster.error(e.response.data.message);
                            })
                    }

                    else{

                        this.$toaster.warning('Будьте внимательны при заполнении полей', {timeout: 5000})
                    }
                })
            },
            deleleteLesson(id,index,day) {
                this.$bvModal.msgBoxConfirm('Вы действительно хотите удалить запись?', {
                    size: 'sm',
                    buttonSize: 'md',
                    okVariant: 'danger',
                    okTitle: 'Да',
                    cancelTitle: 'Отмена',
                    footerClass: 'p-2',
                    hideHeaderClose: false,
                    centered: true
                })
                    .then(value => {

                        if (value){

                            axios.delete('/admin/teacher/head-teacher/timetable/'+id).then((response) =>{
                                if(response.data.response=='deleted')
                                {
                                    this.items[index][day]=null;
                                    this.$refs.table.refresh();
                                    this.$toaster.success("Запись успешно удалена");
                                }

                            }).catch(e => {
                                this.$toaster.error("Пользователь не найден");

                            });
                        }
                    })
                    .catch(err => {

                    })
            },
            OpenModal: function (day,number,rowDay) {
                this.timetableData.rowDay=rowDay;
                this.timetableData.day=day;
                this.timetableData.lesson=number;
                this.show=true;
            },
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

        },
        computed: {
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

        },
        created() {

        }
    }
</script>

<style scoped>
    form {
        margin-top:53px;
    }
    .btn .b-icon.bi{
        font-size: 80%;
    }
    .is-danger {
        color: red;
    }
    .alert-danger{
        border:2px solid red!important;
    }
    table a{
        text-decoration: none;
    }
    .form-container {
        max-width:700px;
    }
</style>
