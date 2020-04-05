<template>
    <form method="get" @submit.prevent="SendData">
    <select v-model="timetableData.grade_id"  name="grade" id="">
        <option value="none">Выберите класс</option>
        <option v-for="grade in grades" :value="grade.id">{{grade.name}}</option>
    </select>
    <select v-model="timetableData.semester" name="semectr" id="">
        <option value="none">Выберите семестр</option>
        <option>1</option>
        <option>2</option>
    </select>
    <input type="submit">
        <ul>
            <li v-for="item in request">{{item.day}}</li>
        </ul>
    </form>
</template>
<script>
    export default {
        name: "IndexTimetable",
        props:['grades'],
        data(){
            return {
                timetableData:
                    {
                        grade_id:'none',
                        semester:'none',
                    },
                counter:1,
                request:{},

                days:['Понедельник','Вторник','Среда','Четверг','Пятница','Суббота']
            }
        },
        methods:{
            SendData(){
                this.$validator.validateAll().then((result) => {
                    if (true) {
                        axios.post(window.routes['admin.teacher.head-teacher.timetable.indexTimetable'], this.timetableData)
                            .then((response) => {
                                if (response.data.result=='OK') {
                                    this.request=response.data.timetable;
                                    console.log(this.request);
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
            }
        }
    }
</script>

<style scoped>
    form {
        margin-top:53px;
    }
</style>
