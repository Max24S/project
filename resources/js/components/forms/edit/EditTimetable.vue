<template>
        <div class="container">
            <form   @submit.prevent="SendData" class="col-xl-10">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Предмет</th>
                        <th scope="col">Преподователь</th>
                        <th scope="col">Кабинет</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                    <td>
                        <select v-model="timetableData['currentSubject']"
                                :name="'subject'" v-validate="'excluded:none'"
                                :class="{'input': true, 'alert-danger':errors.has('subject')}">
                            <option value="none">Выберите предмет</option>
                            <option value="-">Урока нет</option>
                            <option v-for="subject in db['subjects']"
                                    :value="subject.id">
                                {{subject.name}}
                            </option>
                        </select>
                        <span v-show="errors.has('subject')" class="help is-danger">Поле обязательно для заполнения</span>
                    </td>
                        <template  v-if="timetableData['currentSubject']!='-'">
                            <td>
                                {{trackSubject}}
                                <select v-model="timetableData['currentTeacher']"
                                        :name="'teacher'"
                                        v-validate="'excluded:none'"
                                        :class="{'input': true, 'alert-danger':errors.has('teacher')}">
                                    <option value="none">Выберите преподователя</option>
                                    <option v-for="teacher in db['teachers']"
                                            v-if="timetableData['currentSubject']==teacher.subject_id"
                                            :value="teacher.id">
                                             {{teacher.name}}
                                    </option>
                                </select>
                                <span v-show="errors.has('teacher')" class="help is-danger">Поле обязательно для заполнения</span>
                                <span v-if="duplicateTeacher['lesson']" class="help is-danger">У этого преподователя уже есть занятие на этом уроке</span>

                            </td>
                            <td>
                                <select :name="'classroom_id'" v-model="timetableData['classroom_id']"
                                        v-validate="'excluded:none'"
                                        :class="{'input': true, 'alert-danger':errors.has('classroom_id')}">
                                    <option v-for="classroom in db['classrooms']" :value="classroom.id">{{classroom.name}}</option>
                                </select>
                                <span v-show="errors.has('classroom_id')" class="help is-danger">Поле обязательно для заполнения</span>
                                <span v-if="duplicateClassroom['lesson']" class="help is-danger">Кабинет занят</span>
                            </td>
                        </template>
                    </tr>
                    </tbody>
                </table>
                <input  value="Редактировать"  type="submit">
            </form>
        </div>
</template>

<script>
    export default {
        name: "EditTimetable",
        props:['db','rec'],
        data(){
            return{
                timetableData:
                    {
                        currentSubject:'',
                        currentTeacher:"",
                        classroom_id:'',
                    },

                counter:1,
                duplicateTeacher:{
                    'lesson':'',
                },
                duplicateClassroom:{
                    'lesson':'',
                }
                }
        },
        methods: {
            SendData() {
                console.log(this.timetableData);
                this.$validator.validateAll().then((result) => {
                    if (result) {
                            let lesson={};
                            if(this.timetableData['currentSubject']!='-')
                            {
                                if (this.timetableData['currentTeacher']!=this.db['info'][0].id
                                    || this.timetableData['currentSubject']!=this.db['info'][0].subject_id
                                    || this.timetableData['classroom_id']!=this.rec.classroom_id) {
                                    lesson = {
                                        'lesson':this.rec.lesson,
                                        'day': this.rec.day,
                                        'grade_id': this.rec.grade_id,
                                        'subject_user_id': this.timetableData['currentTeacher'],
                                        'classroom_id': this.timetableData['classroom_id'],
                                        'semester': this.rec.semester
                                    }

                                    axios.put('/admin/teacher/head-teacher/timetable/'+this.rec.id, lesson)
                                        .then((response) => {
                                            if (response.data.result=='OK') {
                                                this.$toaster.success('Запись успешно изменина');
                                                document.location.href = "/admin/teacher/head-teacher/timetable/index/"+lesson['grade_id']+"/"+lesson['semester'];
                                            }
                                            else {

                                                if (Object.keys(response.data.duplicateTeacher).length > 0) {

                                                    this.duplicateTeacher['lesson'] = response.data.duplicateTeacher['lesson1' ];
                                                }
                                                else if (Object.keys(response.data.duplicateClassroom).length > 0) {

                                                    this.duplicateClassroom['lesson'] = response.data.duplicateClassroom['lesson1'];
                                                }
                                            }
                                        })
                                        .catch(e => {
                                        })
                                    }
                                else {
                                    this.$toaster.info('Вы не внесли изменений', {timeout: 5000})
                                }
                            }
                        }
                    else{
                        this.$toaster.warning('Будьте внимательны при заполнении полей', {timeout: 5000})
                    }
                })

            }
        },
        computed :{
           trackSubject()
            {
                if(this.timetableData['currentSubject']!=this.db['info'][0].subject_id)
                this.timetableData['currentTeacher']='none';
            }
        },
        created() {

            this.timetableData['currentTeacher']=this.db['info'][0].id;
            this.timetableData['currentSubject']=this.db['info'][0].subject_id;
            this.timetableData['classroom_id']=this.rec.classroom_id;
        },
        updated() {
        }

    }
</script>
<style scoped>
form{
    margin-top:55px;
}
.is-danger {
    color: red;
}
</style>
