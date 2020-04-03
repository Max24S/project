<template>
 <div>
     <select v-model="qurentSubject" name="" id="">
         <option value="none">Не выбрано</option>
        <option v-if="qurentTeacher==='none'|| qurentTeacher=='Математика'">Математика</option>
         <option v-if="qurentTeacher==='none'|| qurentTeacher=='Физика'">Физика</option>
     </select>
     <select v-model="qurentTeacher" name="" id="">
         <option value="none">Не выбрано</option>
         <option v-for="res in result" v-if="qurentSubject==='none'|| qurentSubject==res.subject" :value="res.subject">{{res.teachers}}</option>
     </select>
<!--     <ul >-->
<!--         <li v-for="res in result" v-if="qurentSubject==='none'|| qurentSubject==res.subject" >{{res.teachers}}</li>-->
<!--     </ul>-->

 </div>

</template>

<script>
    export default {
        name: "CreateTimetable.vue",
        props:['result'],
        data(){
            return {
                    qurentSubject:'none',
                    qurentTeacher:'none'
            }
        },
        created() {
        }
    }
</script>

<style scoped>

</style>
