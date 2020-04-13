<template>
    <div>
        <div class="container-fluid">
        <span class="title d-block mb-3">Домашнее задание по предмету: {{subject}}</span>
    </div>
        <table-student :items="items" :fields="fields" :action="action"></table-student>
    </div>
</template>

<script>
    export default {
        name: "IndexHomeworkSubject",
        props:['homeworks','subject'],
        created() {
            console.log(this.homeworks);
            console.log(this.subject);
        },
        data(){
            return {
                items:[{fullName:'Myname',name:"123",description:"hwdada awf awfhajfahwfba fhafvahfbaf afhjwfhabf" }],
                fields:[
                    {key:'fullName',label:'Преподаватель',class:'text-center'},
                    {key:'name',label:'Задание',class:'text-center'},
                    {key:'description',label:'Описание',class:'text-center'},
                    // { key: 'actions', label: 'Действия'}
                ],
                action:{
                    // route:'/student/homework-index/',
                    // content:'Домашние задания'
                }
            }
        }
    }
</script>

<style scoped>
    .title {
        font-size: 28px;
    }
</style>
