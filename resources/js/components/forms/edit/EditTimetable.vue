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
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
<!--                        <th scope="row">-->
<!--                            <div :name="'lesson'+n">{{n}}</div>-->
<!--                            <input type="hidden" :name="'lesson'+n":value="n" id="">-->
<!--                        </th>-->
<!--                        <td>-->
<!--                            <select v-model="timetableData['currentSubject'+n]"-->
<!--                                    :name="'subject'+n" v-validate="'excluded:none'"-->
<!--                                    :class="{'input': true, 'alert-danger':errors.has('subject'+n)}">-->
<!--                                <option value="none">Выберите предмет</option>-->
<!--                                <option value="-">Урока нет</option>-->
<!--                                <option v-for="subject in timetable['subjects']"-->
<!--                                        v-if="timetableData['currentTeacher'+n]==='none'|| timetableData['currentTeacher'+n].subject_id==subject.id"-->
<!--                                        :value="subject.id">-->
<!--                                    {{subject.name}}-->
<!--                                </option>-->
<!--                            </select>-->
<!--                            <span v-show="errors.has('subject'+n)" class="help is-danger">Поле обязательно для заполнения</span>-->
<!--                        </td>-->

                        <template v-if="timetableData['currentSubject']!='-'">
                            <td>
                                {{timetableData['currentTeacher']}}
                                <select v-model="timetableData['currentTeacher']"
                                        :name="'teacher'"
                                        v-validate="'excluded:none'"
                                        :class="{'input': true, 'alert-danger':errors.has('teacher')}">
                                    <option v-for="teacher in timetable['teachers']"
                                            :value="teacher">
                                        {{teacher.teachers}}
                                    </option>
                                </select>
                                <select v-model="timetableData['currentTeacher']" name="" id="">
                                    <option v-for="teacher in timetable['teachers']"
                                            :value="teacher.id">
                                        {{teacher.teachers}}
                                    </option>
                                </select>
                                <v-select
                                    v-model="timetableData['currentTeacher']"
                                    :options="this.timetable['teachers']"
                                    :reduce="teacher => teacher.id"
                                    label="teachers">
                                </v-select>
                                <span v-show="errors.has('teacher')" class="help is-danger">Поле обязательно для заполнения</span>
                                <span v-if="duplicateTeacher['lesson']" class="help is-danger">У этого преподователя уже есть занятие на этом уроке</span>
                            </td>
<!--                            <td>-->
<!--                                <select :name="'classroom_id'+n" v-model="timetableData['classroom_id'+n]"-->
<!--                                        v-validate="'excluded:none'"-->
<!--                                        :class="{'input': true, 'alert-danger':errors.has('classroom_id'+n)}">-->
<!--                                    <option value='none'>Выберите кабинет</option>-->
<!--                                    <option v-for="classroom in timetable['classrooms']" :value="classroom.id">{{classroom.name}}</option>-->
<!--                                </select>-->
<!--                                <span v-show="errors.has('classroom_id'+n)" class="help is-danger">Поле обязательно для заполнения</span>-->
<!--                            </td>-->
                        </template>
                    </tr>
                    </tbody>
                </table>
                <input type="submit">
            </form>
        </div>
</template>

<script>
    export default {
        name: "EditTimetable",
        props:['timetable','rec'],
        data(){
            return{
                timetableData:
                    {
                        currentSubject:'none',
                        currentTeacher:"7",
                        classroom_id1:'none',
                        grade_id:'none',
                        day:'none',
                        semester:'none',
                    },
                counter:1,
                duplicateTeacher:{
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
        created() {
            console.log(this.rec);

            console.log(  this.timetable['teachers']);
        }
    }
</script>

<style scoped>

</style>
