<template>
    <div class="container">
        <form @submit.prevent="SendData" class="col-xl-10">
             <table class="table">
                 <thead class="thead-dark">
                 <tr>
                     <th scope="col">Урок</th>
                     <th scope="col">Предмет</th>
                     <th scope="col">Преподователь</th>
                     <th scope="col">Кабинет</th>
                     <th scope="col">
                         <select name="day" v-model="timetableData.day" v-validate="'excluded:none'"
                                 :class="{'input': true, 'alert-danger':errors.has('day')}">
                             <option value="none">Выберите день недели</option>
                             <option v-for="day in days">{{day}}</option>
                         </select>
                         <span v-if="errors.has('day')" class="help is-danger">{{ errors.first('day') }}</span>
                     </th>
                     <th scope="col">
                         <select name="grade_id" v-model="timetableData.grade_id" v-validate="'excluded:none'"
                                  :class="{'input': true, 'alert-danger':errors.has('grade_id')}">
                             <option value="none">Выберите класс</option>
                             <option v-for="grade in teachersAndSubjects['grades']" :value="grade.id">{{grade.name}}</option>
                         </select>
                         <span v-if="errors.has('grade_id')" class="help is-danger">{{ errors.first('grade_id') }}</span>
                     </th>
                     <th scope="col">
                         <select name="semester" v-model="timetableData.semester"
                                 v-validate="'excluded:none'"
                                 :class="{'input': true, 'alert-danger':errors.has('semester')}">
                             <option value="none">Выберите семестр</option>
                             <option >1</option>
                             <option >2</option>
                         </select>
                         <span v-if="errors.has('semester')" class="help is-danger">{{ errors.first('semester') }}</span>
                     </th>
                 </tr>
                 </thead>
                 <tbody>
                 <tr v-if="n<=counter" v-for="n in 8">
                     <th scope="row">
                         <div :name="'lesson'+n">{{n}}</div>
                         <input type="hidden" :name="'lesson'+n":value="n" >
                     </th>
                     <td>
                         <select v-model="timetableData['currentSubject'+n]"
                                 :name="'subject'+n" v-validate="'excluded:none'"
                                 :class="{'input': true, 'alert-danger':errors.has('subject'+n)}">
                             <option value="none">Выберите предмет</option>
                             <option value="-">Урока нет</option>
                             <option v-for="subject in teachersAndSubjects['subjects']"
                                     :value="subject.id">
                                 {{subject.name}}
                             </option>
                         </select>
                         <span v-if="errors.has('subject'+n)" class="help is-danger">Поле обязательно для заполнения</span>
                     </td>
                     <template v-if="timetableData['currentSubject'+n]!='-'">
                     <td>
                         <select v-model="timetableData['currentTeacher'+n]"
                                :name="'teacher'+n"
                                 v-validate="'excluded:none'"
                                 :class="{'input': true, 'alert-danger':errors.has('teacher'+n)}">
                             <option value="none">Выберите преподователя</option>
                             <option v-for="teacher in teachersAndSubjects['teachers']"
                                     v-if="timetableData['currentSubject'+n]==='none'|| timetableData['currentSubject'+n]==teacher.subject_id"
                                     :value="teacher">
                                 {{teacher.surname}} {{teacher.name}} {{teacher.patronymic}}
                             </option>
                         </select>
                         <span v-if="errors.has('teacher'+n)" class="help is-danger">Поле обязательно для заполнения</span>
                         <span v-if="duplicateTeacher['lesson'+n]" class="help is-danger">У этого преподователя уже есть занятие на этом уроке</span>
                     </td>
                     <td>
                     <select :name="'classroom_id'+n" v-model="timetableData['classroom_id'+n]"
                             v-validate="'excluded:none'"
                             :class="{'input': true, 'alert-danger':errors.has('classroom_id'+n)}">
                         <option value='none'>Выберите кабинет</option>
                         <option v-for="classroom in teachersAndSubjects['classrooms']" :value="classroom.id">{{classroom.name}}</option>
                     </select>
                     <span v-if="errors.has('classroom_id'+n)" class="help is-danger">Поле обязательно для заполнения</span>
                     <span v-if="duplicateClassroom['lesson'+n]" class="help is-danger">Кабинет занят</span>
                     </td>
                     </template>
                 </tr>
                 </tbody>
             </table>
             <input type="submit">
             <div v-if="counter<8" @click="AddLesson">Добавить поле</div>
             <div v-if="counter>1" @click="RemoveLesson">Убрать поле</div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "CreateTimetable.vue",
        props:['teachers-and-subjects'],
        data(){
            return {
                timetableData:
                {
                    currentSubject1:'none',
                    currentTeacher1:'none',
                    classroom_id1:'none',
                    grade_id:'none',
                    day:'none',
                    semester:'none',
                },
                counter:1,
                request:{},
                days:['Понедельник','Вторник','Среда','Четверг','Пятница','Суббота'],
                duplicateTeacher:{
                    'lesson1':'',
                    'lesson2':'',
                    'lesson3':'',
                    'lesson4':'',
                    'lesson5':'',
                    'lesson6':'',
                    'lesson7':'',
                    'lesson8':''
                },
                duplicateClassroom:{
                    'lesson1':'',
                    'lesson2':'',
                    'lesson3':'',
                    'lesson4':'',
                    'lesson5':'',
                    'lesson6':'',
                    'lesson7':'',
                    'lesson8':''
                }
            }
        },
        methods: {
            SendData() {
                for( let lesson in this.duplicateTeacher)
                {
                    this.duplicateTeacher[lesson]='';
                }
                for( let lesson in this.duplicateClassroom)
                {
                    this.duplicateClassroom[lesson]='';
                }
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        for ( let i=1;i<=this.counter;i++) {
                            let lesson={};
                            if(this.timetableData['currentSubject' + i]!='-')
                            {
                                lesson = {
                                    'lesson': i, 'day': this.timetableData.day,
                                    'grade_id': this.timetableData.grade_id,
                                    'subject_user_id':this.timetableData['currentTeacher'+i].id,
                                    'classroom_id':this.timetableData['classroom_id'+i],
                                    'semester': this.timetableData.semester
                                }
                                this.request[i] =lesson;
                            }
                        }
                             axios.post(window.routes['admin.teacher.head-teacher.timetable.store'], this.request)
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
                                            for (let i = 1; i <= 8; i++) {
                                                this.duplicateTeacher['lesson' + i] = response.data.duplicateTeacher['lesson' + i];

                                            }
                                        }
                                        if (Object.keys(response.data.duplicateClassroom).length > 0) {
                                            for (let i = 1; i <= 8; i++) {
                                                this.duplicateClassroom['lesson' + i] = response.data.duplicateClassroom['lesson' + i];
                                            }
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
            ,
            AddLesson() {
                this.counter++;
               let item=this.counter;
                this.timetableData['currentSubject'+item]='none';
                this.timetableData['currentTeacher'+item]='none';
                this.timetableData['classroom_id'+item]='none';
            },
            RemoveLesson(){
                let item=this.counter;
                confirm('Are you sure you want to delete this item?') && delete this.timetableData['currentSubject'+item]
                && delete this.timetableData['currentTeacher'+item]
                && delete this.timetableData['classroom_id'+item];
                this.counter--;
            }
        },
        created() {
            console.log(this.teachersAndSubjects)
        }
    }
</script>

<style scoped>
    form {
        margin-top:53px;
    }
    .is-danger {
        color: red;
    }
    .alert-danger{
        border:2px solid red!important;
    }
</style>
