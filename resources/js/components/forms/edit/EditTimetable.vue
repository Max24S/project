<template>
        <div class="container">
            <form class="col-xl-10">
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
<!--                    <th scope="row">-->
<!--                        <div :name="'lesson'+n">{{n}}</div>-->
<!--                        <input type="hidden" :name="'lesson'":value="n" id="">-->
<!--                    </th>-->
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
                        <template v-if="timetableData['currentSubject']!='-'">
                            <td>
                                {{timetableData['currentTeacher']}}
                                <select v-model="timetableData['currentTeacher']"
                                        :name="'teacher'"
                                        v-validate="'excluded:none'"
                                        :class="{'input': true, 'alert-danger':errors.has('teacher')}">
                                    <option v-for="teacher in db['teachers']"
                                            v-if="timetableData['currentSubject']==='none'|| timetableData['currentSubject']==teacher.subject_id"
                                            :value="teacher.id">
                                        {{teacher.name}}
                                    </option>
                                </select>
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
            <button @click="showMsgBoxDelelete(rec.id)">Удалить</button>
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
        methods:{
            showMsgBoxDelelete(id) {
                console.log(id);
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
                                console.log(this.routes.Delete+id);
                                if(response.data.response=='deleted')
                                {
                                    // this.$refs.table.refresh();

                                    this.$toaster.success("Запись успешно удалена");

                                }

                            }).catch(e => {
                                // this.$toaster.error("Пользователь не найден");

                            });
                        }
                    })
                    .catch(err => {

                    })
            },
        },
        created() {

            this.timetableData['currentTeacher']=this.db['info'][0].id;
            this.timetableData['currentSubject']=this.db['info'][0].subject_id;
            console.log( this.timetableData['currentSubject']);
            console.log(this.timetableData['currentTeacher']);
            console.log(this.rec);
            console.log(this.db)
        }
    }
</script>

<style scoped>

</style>
