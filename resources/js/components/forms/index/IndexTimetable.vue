<template>
    <div>
        <form method="get" @submit.prevent="SendData">
        <select v-model="timetableData.grade_id"  name="grade">
            <option value="none">Выберите класс</option>
            <option v-for="grade in teachersAndSubjects['grades']" :value="grade.id">{{grade.name}}</option>
        </select>
        <select v-model="timetableData.semester" name="semectr">
            <option value="none">Выберите семестр</option>
            <option selected>1</option>
            <option>2</option>
        </select>
        <input type="submit">
    </form>
    <b-container fluid >
        <!-- User Interface controls -->
        <b-row>
            <b-col lg="6" class="my-1">
                <b-form-group
                    label="Filter"
                    label-cols-sm="3"
                    label-align-sm="right"
                    label-size="sm"
                    label-for="filterInput"
                    class="mb-0"
                >
                    <b-input-group size="sm">
                        <b-form-input
                            v-model="filter"
                            type="search"
                            id="filterInput"
                            placeholder="Type to Search"
                        ></b-form-input>
                        <b-input-group-append>
                            <b-button :disabled="!filter" @click="filter = ''">Clear</b-button>
                        </b-input-group-append>
                    </b-input-group>
                </b-form-group>
            </b-col>

            <b-col sm="5" md="6" class="my-1">
                <b-form-group
                    label="Per page"
                    label-cols-sm="6"
                    label-cols-md="4"
                    label-cols-lg="3"
                    label-align-sm="right"
                    label-size="sm"
                    label-for="perPageSelect"
                    class="mb-0"
                >
                    <b-form-select
                        v-model="perPage"
                        id="perPageSelect"
                        size="sm"
                        :options="pageOptions"
                    ></b-form-select>
                </b-form-group>
            </b-col>

            <b-col sm="7" md="6" class="my-1">
                <b-pagination
                    v-model="currentPage"
                    :total-rows="totalRows"
                    :per-page="perPage"
                    align="fill"
                    size="sm"
                    class="my-0"
                ></b-pagination>
            </b-col>
        </b-row>

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
                <b-button @click="deleleteLesson(row.value.id,row.index,'tuesday')" v-if="row.value.subjects" class="mr-3"><b-icon-trash-fill></b-icon-trash-fill></b-button>
                <a :href="'timetable/'+row.value.id+'/edit'"><span class="d-block text-center">{{row.value.subjects}}</span><span class="d-block text-center">{{ row.value.classroom}}</span></a>
                <b-button v-if="!row.value.subjects" @click="OpenModal('Вторник',row.item.lesson)" variant="primary"><b-icon-plus></b-icon-plus></b-button>
            </template>
            <template v-slot:cell(tuesday)="row">
                    <b-button @click="deleleteLesson(row.value.id,row.index,'tuesday')" v-if="row.value.subjects" class="mr-3"><b-icon-trash-fill></b-icon-trash-fill></b-button>
                <a :href="'timetable/'+row.value.id+'/edit'"><span class="d-block text-center">{{row.value.subjects}}</span><span class="d-block text-center">{{ row.value.classroom}}</span></a>
                    <b-button  v-if="!row.value.subjects" @click="OpenModal('Вторник',row.item.lesson)" variant="primary"><b-icon-plus></b-icon-plus></b-button>
            </template>
            <template v-slot:cell(wednesday)="row">
                <b-button @click="deleleteLesson(row.value.id,row.index,'wednesday')" v-if="row.value.subjects" class="mr-3"><b-icon-trash-fill></b-icon-trash-fill></b-button>
                <a :href="'timetable/'+row.value.id+'/edit'"><span class="d-block text-center">{{row.value.subjects}}</span><span class="d-block text-center">{{ row.value.classroom}}</span></a>
                <b-button  v-if="!row.value.subjects" @click="OpenModal('Среда',row.item.lesson)" variant="primary"><b-icon-plus></b-icon-plus></b-button>
            </template>
            <template v-slot:cell(thursday)="row">
                <b-button @click="deleleteLesson(row.value.id,row.index,'thursday')" v-if="row.value.subjects" class="mr-3"><b-icon-trash-fill></b-icon-trash-fill></b-button>
                <a :href="'timetable/'+row.value.id+'/edit'"><span class="d-block text-center">{{row.value.subjects}}</span><span class="d-block text-center">{{ row.value.classroom}}</span></a>
                <b-button  v-if="!row.value.subjects" @click="OpenModal('Четверг',row.item.lesson)" variant="primary"><b-icon-plus></b-icon-plus></b-button>
            </template>
            <template v-slot:cell(friday)="row">
                <b-button @click="deleleteLesson(row.value.id,row.index,'friday')" v-if="row.value.subjects" class="mr-3"><b-icon-trash-fill></b-icon-trash-fill></b-button>
                <a :href="'timetable/'+row.value.id+'/edit'"><span class="d-block text-center">{{row.value.subjects}}</span><span class="d-block text-center">{{ row.value.classroom}}</span></a>
                <b-button @click="OpenModal('Пятница',row.item.lesson)" variant="primary"><b-icon-plus></b-icon-plus></b-button>
            </template>
            <template v-slot:cell(saturday)="row">
                <b-button @click="deleleteLesson(row.value.id,row.index,'saturday')" v-if="row.value.subjects" class="mr-3"><b-icon-trash-fill></b-icon-trash-fill></b-button>
                <a :href="'timetable/'+row.value.id+'/edit'"><span class="d-block text-center">{{row.value.subjects}}</span><span class="d-block text-center">{{ row.value.classroom}}</span></a>
                <b-button @click="OpenModal('Суббота',row.item.lesson)" variant="primary"><b-icon-plus></b-icon-plus></b-button>
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

        <b-modal
                size="md"
                v-model="show"
                title="Modal Variants">
            <b-container fluid>
                <b-row class="mb-1">
                    <b-col sm="3">
                        <b-col>Предмет</b-col>
                        <select v-model="timetableData['currentSubject']"
                                :name="'subject'" v-validate="'excluded:none'"
                                :class="{'input': true, 'alert-danger':errors.has('subject')}">
                            <option value="none">Выберите предмет</option>
                            <option value="-">Урока нет</option>
                            <option v-for="subject in teachersAndSubjects['subjects']"
                                    :value="subject.id">
                                {{subject.name}}
                            </option>
                        </select>
                        <span v-if="errors.has('subject')" class="help is-danger">Поле обязательно для заполнения</span>
                    </b-col>
                    <template v-if="timetableData['currentSubject']!='-'">
                    <b-col md="10">
                        <div class="row">
                            <div class="col-md-4">Преподователь</div>
                            <div class="col-md-8">
                            <select v-model="timetableData['currentTeacher']"
                                    :name="'teacher'"
                                    v-validate="'excluded:none'"
                                    :class="{'input': true, 'alert-danger':errors.has('teacher')}">
                                <option value="none">Выберите преподователя</option>
                                <option v-for="teacher in teachersAndSubjects['teachers']"
                                        v-if="timetableData['currentSubject']==='none'|| timetableData['currentSubject']==teacher.subject_id"
                                        :value="teacher">
                                    {{teacher.surname}} {{teacher.name}} {{teacher.patronymic}}
                                </option>
                            </select>
                            <span v-if="errors.has('teacher')" class="help is-danger">Поле обязательно для заполнения</span>
                            </div>
<!--                        <span v-if="duplicateTeacher['lesson']" class="help is-danger">У этого преподователя уже есть занятие на этом уроке</span>-->
                        </div>
                    </b-col>
                    <b-col sm="3">
                        <b-col>Класс</b-col>
                        <select :name="'classroom_id'" v-model="timetableData['classroom_id']"
                                v-validate="'excluded:none'"
                                :class="{'input': true, 'alert-danger':errors.has('classroom_id')}">
                            <option value='none'>Выберите кабинет</option>
                            <option v-for="classroom in teachersAndSubjects['classrooms']" :value="classroom.id">{{classroom.name}}</option>
                        </select>
                        <span v-if="errors.has('classroom_id')" class="help is-danger">Поле обязательно для заполнения</span>
<!--                        <span v-if="duplicateClassroom['lesson']" class="help is-danger">Кабинет занят</span>-->
                    </b-col>
                    </template>
                </b-row>
            </b-container>
            <template v-slot:modal-footer>
                <div class="w-100">
                    <b-button
                            variant="primary"
                            size="sm"
                            class="float-right"
                            @click="AddLesson"
                    >
                        Ok
                    </b-button>
                    <b-button
                            variant="primary"
                            size="sm"
                            class="float-right"
                            @click="show=false"
                    >
                    Close
                    </b-button>
                </div>
            </template>
        </b-modal>
    </b-container>
    </div>
</template>
<script>

    export default {
        name: "IndexTimetable",
        props:['teachers-and-subjects'],
        data(){
            return {
                timetableData:
                    {
                        currentSubject:'none',
                        currentTeacher:'none',
                        classroom_id:'none',
                        grade_id:'none',
                        semester:'none',
                    },
                counter:1,
                request:{},
                items:[],
                lessons: {
                    day:'',
                    number:'',

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
                pageOptions: [5, 10, 15],
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
            SendData(){
                this.$validator.validateAll().then((result) => {
                    if (true) {
                        axios.post(window.routes['admin.teacher.head-teacher.timetable.indexTimetable'], this.timetableData)
                            .then((response) => {
                                if (response.data.result=='OK') {
                                    this.items=response.data.timetable;
                                    this.isVisible=1;
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
            OpenModal: function (day,number) {
                this.lessons.day=day;
                this.lessons.number=number;
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
            AddLesson(){
                this.$validator.validateAll().then((result) => {
                    if (result) {
                            let lesson={};
                            if(this.timetableData['currentSubject']!='-')
                            {
                                lesson = {
                                    'lesson': this.lessons.number,
                                    'day': this.lessons.day,
                                    'grade_id': this.timetableData.grade_id,
                                    'subject_user_id':this.timetableData['currentTeacher'].id,
                                    'classroom_id':this.timetableData['classroom_id'],
                                    'semester': this.timetableData.semester
                                }
                        }
                        axios.post('/admin/teacher/head-teacher/timetable/StoreLesson', lesson)
                            .then((response) => {
                                if (response.data.result=='OK') {
                                    this.$toaster.success('Расписание успешно добавленно');
                                }
                                else {
                                    if (response.data.result == 'isset') {

                                        this.$toaster.info('Расписание на этот день для этого класса уже есть,перейдите в раздел редактирования', {timeout: 5000})
                                    }
                                    else {
                                        if (Object.keys(response.data.duplicateTeacher).length > 0) {

                                                this.duplicateTeacher['lesson' ] = response.data.duplicateTeacher['lesson'];

                                        }
                                        if (Object.keys(response.data.duplicateClassroom).length > 0) {

                                                this.duplicateClassroom['lesson'] = response.data.duplicateClassroom['lesson'];
                                        }
                                    }
                                }
                            })
                            .catch(e => {
                            })
                    }
                    else{
                        this.$toaster.warning('Будьте внимательны при заполнении полей', {timeout: 5000})
                    }
                })
            }
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
</style>
