<template>
    <b-modal
            size="md"
            v-model="show"
            title="Cоздание записи урока">
        <b-container fluid>
            {{Show}}
            <div class="form-group row mb-1">
                <label for="subject_id" class="col-sm-4 col-form-label">Предмет</label>
                <div class="col-sm-8">
                    <select v-model="currentSubject"
                        id="subject_id"
                        :name="'subject'" v-validate="'excluded:none'"
                        :class="{'input': true, 'alert-danger':errors.has('subject')}">
                        <option value="none">Выберите предмет</option>
                        <option v-for="subject in teachersAndSubjects['subjects']"
                                :value="subject">
                            {{subject.name}}
                        </option>
                    </select>
                    <span v-if="errors.has('subject')" class="help is-danger d-block">Поле обязательно для заполнения</span>
                </div>
            </div>
            <template v-if="currentSubject!='-'">
                <div class="form-group row mb-1">
                    <label for="teacher_id" class="col-sm-4 col-form-label">Преподователь</label>
                    <div class="col-sm-8">
                        <select v-model="currentTeacher"
                             id="teacher_id"
                            :name="'teacher'"
                            v-validate="'excluded:none'"
                            :class="{'input': true, 'alert-danger':errors.has('teacher')}">
                        <option value="none">Выберите преподователя</option>
                        <option v-for="teacher in teachersAndSubjects['teachers']"
                                v-if="currentSubject==='none'|| currentSubject.id==teacher.subject_id"
                                :value="teacher">
                            {{teacher.surname}} {{teacher.name}} {{teacher.patronymic}}
                        </option>
                    </select>
                    <span v-if="duplicateTeacher['lesson']" class="help is-danger d-block">У этого преподователя уже есть занятие на этом уроке</span>
                    <span v-if="errors.has('teacher')" class="help is-danger d-block">Поле обязательно для заполнения</span>
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="classroom_id" class="col-sm-4 col-form-label">Класс</label>
                    <div class="col-sm-8">
                        <select
                                id="classroom_id"
                                :name="'classroom'"
                                v-model="classroom_id"
                                v-validate="'excluded:none'"
                                :class="{'input': true, 'alert-danger':errors.has('classroom')}">
                            <option value='none'>Выберите кабинет</option>
                            <option v-for="classroom in teachersAndSubjects['classrooms']" :value="classroom">{{classroom.name}}</option>
                        </select>
                        <span v-if="duplicateClassroom['lesson']" class=" d-block help is-danger">Кабинет занят</span>
                        <span v-if="errors.has('classroom')" class=" d-block help is-danger ">Поле обязательно для заполнения</span>
                    </div>
                 </div>
            </template>
        </b-container>
        <template v-slot:modal-footer>
            <div class="w-100">
                <b-button
                        squared variant="dark"
                        size="md"
                        class="float-left"
                        @click="Cancel()"
                >
                   Закрыть
                </b-button>
                <b-button
                        squared variant="warning"
                        size="md"
                        class="float-right"
                        @click="AddLesson"
                >
                    Добавить
                </b-button>
            </div>
        </template>
    </b-modal>
</template>

<script>
    export default {
        name: "Add-Lesson",
        props:['teachers-and-subjects','timetable','visible'],
        data(){
            return{
                currentSubject:'none',
                currentTeacher:'none',
                classroom_id:'none',
                show:false,
                duplicateTeacher:{
                    lesson:""
                },
                duplicateClassroom:{
                    lesson:""
                }
            }
        },
        methods:{
            Cancel(){
                this.show=false;
                this.$emit('hide', false)
            },
            SendLessonForTable(lesson){
                this.$emit('lesson', lesson);
            },
            AddLesson(){
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        let lesson={};
                        if(this.timetable['currentSubject']!='-')
                        {
                            lesson = {
                                'lesson': this.timetable.lesson,
                                'day': this.timetable.day,
                                'grade_id': this.timetable.grade_id,
                                'subject_user_id':this.currentTeacher.id,
                                'classroom_id':this.classroom_id.id,
                                'semester': this.timetable.semester
                            }
                        }

                        axios.post('/admin/teacher/head-teacher/timetable/StoreLesson', lesson)
                            .then((response) => {
                                if (response.data[0].result=='OK') {
                                    this.$toaster.success('Расписание успешно добавленно');
                                   let cell={
                                        'dayRow':this.timetable.rowDay,
                                        'day': this.timetable.day,
                                        'lesson': this.timetable.lesson,
                                        'id':response.data[1],
                                        'subject':this.currentSubject.name,
                                        'classroom':this.classroom_id.name
                                    }
                                    this.SendLessonForTable(cell);
                                    this.show=false;
                                }
                                else {

                                    if (Object.keys(response.data[0].duplicateTeacher).length > 0) {

                                        this.duplicateTeacher['lesson' ] = response.data[0].duplicateTeacher['lesson'+ this.timetable.lesson];

                                    }
                                    if (Object.keys(response.data[0].duplicateClassroom).length > 0) {

                                        this.duplicateClassroom['lesson'] = response.data[0].duplicateClassroom['lesson'+ this.timetable.lesson];
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
        computed:{
            Show(){
                this.show=this.visible;
            }
        },
        updated() {

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