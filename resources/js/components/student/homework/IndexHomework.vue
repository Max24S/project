<template>
    <table-student :items="items" :fields="fields" :action="action"></table-student>
</template>

<script>
    export default {
        name: "IndexHomeworkSubject",
        props:['subjects'],
        data(){
            return {
                items:[{name:'Myname'}],
                fields:[
                    {key:'name',label:'Предмет'},
                    { key: 'actions', label: 'Действия'}
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

</style>
