<template>
 <form @submit.prevent="SendData">
     <table class="table">
         <thead class="thead-dark">
         <tr>
             <th scope="col">Урок</th>
             <th scope="col">Предмет</th>
             <th scope="col">Преподователь</th>
             <th scope="col">
                 <select name="day">
                     <option value="none">Выберите день недели</option>
                     <option v-for="day in days">{{day}}</option>
                 </select>
<!--                 @error('day')-->
<!--                 <div class="alert alert-danger">{{ $message }}</div>-->
<!--                 @enderror-->
             </th>
             <th scope="col">
                 <select name="grade_id" id="">
                     <option value="none">Выберите класс</option>
                     <option v-for="grade in teachersAndSubjects['grades']" :value="grade.id">{{grade.name}}</option>
                 </select>
<!--                 @error('grade_id')-->
<!--                 <div class="alert alert-danger">{{ $message }}</div>-->
<!--                 @enderror-->
             </th>
             <th scope="col">
                 <select name="classroom_id" id="">
                     <option value="none">Выберите кабинет</option>
                     <option v-for="classroom in teachersAndSubjects['classrooms']" :value="classroom.id">{{classroom.name}}</option>
                 </select>
<!--                 @error('grade_id')-->
<!--                 <div class="alert alert-danger">{{ $message }}</div>-->
<!--                 @enderror-->
             </th>
             <th scope="col">
                 <select name="semester" id="">
                     <option value="none">Выберите семестр</option>
                     <option >1</option>
                     <option >2</option>
                 </select>
<!--                 @error('semester')-->
<!--                 <div class="alert alert-danger">{{ $message }}</div>-->
<!--                 @enderror-->
             </th>
         </tr>
         </thead>
         <tbody>
<!--         @for($i=1;$i<9;$i++)-->
         <tr v-for="n in 9">
             <th scope="row">
                 <div :name="'lesson'+n">{{n}}</div>
                 <input type="hidden" :name="'lesson'+n" :value="n" id="">
             </th>
             <td>
                 <select v-model="timetableData['currentSubject'+n]" name="subject" id="">
                     <option value="none">Выберите предмет</option>
                     <option v-for="subject in teachersAndSubjects['subjects']"
                             v-if="timetableData['currentTeacher'+n]==='none'|| timetableData['currentTeacher'+n]==subject.id"
                             :value="subject.id">
                         {{subject.name}}
                     </option>
                 </select>
<!--                 @error("subject".$i)-->
<!--                 <div class="alert alert-danger">{{ $message }}</div>-->
<!--                 @enderror-->
             </td>
             <td>
                 <select v-model="timetableData['currentTeacher'+n]"  ref="select" name="teacher" id="">
                     <option value="none">Выберите преподователя</option>
                     <option v-for="teacher in teachersAndSubjects['teachers']"
                             v-if="timetableData['currentSubject'+n]==='none'|| timetableData['currentSubject'+n]==teacher.subject_id"
                             :value="teacher.subject_id" :teacher-id="teacher.id">
                         {{teacher.teachers}}
                     </option>
                 </select>
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
        methods:{
            SendData(){
                const attrValue = this.$refs.select.options[this.$refs.select.selectedIndex].getAttribute('teacher-id');
                this.timetableData['subject_user_id']=attrValue;
                console.log(attrValue);
            }
        },
        created() {
        }
    }
</script>

<style scoped>

</style>
