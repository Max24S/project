<template>
 <form @submit.prevent="SendData">
     <table class="table">
         <thead class="thead-dark">
         <tr>
             <th scope="col">Урок</th>
             <th scope="col">Предмет</th>
             <th scope="col">Преподователь</th>
             <th scope="col">
                 <select name="day" v-validate="'excluded:none'"
                         :class="{'input': true, 'alert-danger':errors.has('day')}">
                     <option value="none">Выберите день недели</option>
                     <option v-for="day in days">{{day}}</option>
                 </select>
                 <span v-show="errors.has('day')" class="help is-danger">{{ errors.first('day') }}</span>
             </th>
             <th scope="col">
                 <select name="grade_id"  v-validate="'excluded:none'" id="" :class="{'input': true, 'alert-danger':errors.has('grade_id')}">
                     <option value="none">Выберите класс</option>
                     <option v-for="grade in teachersAndSubjects['grades']" :value="grade.id">{{grade.name}}</option>
                 </select>
                 <span v-show="errors.has('grade_id')" class="help is-danger">{{ errors.first('grade_id') }}</span>
             </th>
             <th scope="col">
                 <select name="classroom_id"  v-validate="'excluded:none'"id="" :class="{'input': true, 'alert-danger':errors.has('classroom_id')}">
                     <option value="none">Выберите кабинет</option>
                     <option v-for="classroom in teachersAndSubjects['classrooms']" :value="classroom.id">{{classroom.name}}</option>
                 </select>
                 <span v-show="errors.has('classroom_id')" class="help is-danger">{{ errors.first('classroom_id') }}</span>
             </th>
             <th scope="col">
                 <select name="semester" v-validate="'excluded:none'"id="" :class="{'input': true, 'alert-danger':errors.has('semester')}">
                     <option value="none">Выберите семестр</option>
                     <option >1</option>
                     <option >2</option>
                 </select>
                 <span v-show="errors.has('semester')" class="help is-danger">{{ errors.first('semester') }}</span>
             </th>
         </tr>
         </thead>
         <tbody>
         <tr v-for="n in 8">
             <th scope="row">
                 <div :name="'lesson'+n">{{n}}</div>
                 <input type="hidden" :name="'lesson'+n" :value="n" id="">
             </th>
             <td>
                 <select v-model="timetableData['currentSubject'+n]"
                         :name="'subject'+n" v-validate="'excluded:none'"
                         :class="{'input': true, 'alert-danger':errors.has('subject'+n)}">
                     <option value="none">Выберите предмет</option>
                     <option v-for="subject in teachersAndSubjects['subjects']"
                             v-if="timetableData['currentTeacher'+n]==='none'|| timetableData['currentTeacher'+n]==subject.id"
                             :value="subject.id">
                         {{subject.name}}
                     </option>
                 </select>
                 <span v-show="errors.has('subject'+n)" class="help is-danger">Поле обязательно для заполнения</span>
             </td>
             <td>
                 <select v-model="timetableData['currentTeacher'+n]"
                         ref="select" :name="'teacher'+n"
                         v-validate="'excluded:none'"
                         :class="{'input': true, 'alert-danger':errors.has('teacher'+n)}">
                     <option value="none">Выберите преподователя</option>
                     <option v-for="teacher in teachersAndSubjects['teachers']"
                             v-if="timetableData['currentSubject'+n]==='none'|| timetableData['currentSubject'+n]==teacher.subject_id"
                             :value="teacher.subject_id"
                             :teacher-id="teacher.id">
                         {{teacher.teachers}}
                     </option>
                 </select>
                 <span v-show="errors.has('teacher'+n)" class="help is-danger">Поле обязательно для заполнения</span>
             </td>
         </tr>
         </tbody>
     </table>
     <input type="submit">

 </form>
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
                    currentSubject2:'none',
                    currentTeacher2:'none',
                    currentSubject3:'none',
                    currentTeacher3:'none',
                    currentSubject4:'none',
                    currentTeacher4:'none',
                    currentSubject5:'none',
                    currentTeacher5:'none',
                    currentSubject6:'none',
                    currentTeacher6:'none',
                    currentSubject7:'none',
                    currentTeacher7:'none',
                    currentSubject8:'none',
                    currentTeacher8:'none',

                }
                ,
                days:['Понедельник','Вторник','Среда','Четверг','Пятница','Суббота']
            }
        },
        methods: {
            SendData() {
                // let attrValue = this.$refs.select.
                    // options[this.$refs.select.selectedIndex].getAttribute('teacher-id');
                // this.timetableData['subject_user_id'] = attrValue;
                console.log(this.$refs.select[1].options[this.$refs.select[1].selectedIndex].getAttribute('teacher-id'));
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        // eslint-disable-next-line

                        return;
                    }
                    this.$toaster.success('Your toaster success message.');
                })
            }
        },
        created() {
            console.log(this.teachersAndSubjects)
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
