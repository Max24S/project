<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform" xmlns="http://www.w3.org/1999/html">

    <table-admin :items="teachers" :fields="fields" :routes="routes"></table-admin>

</template>

<script>
    export default {
        props:['teachers'],
        created(){
            console.log(this.teachers)
        },
        data() {
            return {
                routes:{
                    Create:'/admin/super/user/create',
                    Edit:'/admin/super/user/',
                    Delete:'/admin/super/user/'
                },
                fields: [
                    { key: 'id',label: 'id', sortable: true,sortDirection: 'desc', class: 'text-center' },
                    { key: 'name', label: 'Имя', sortable: true,sortDirection: 'desc', class: 'text-center' },
                    { key: 'surname', label: 'фамилия', sortable: true, sortDirection: 'desc' ,class: 'text-center'},
                    { key: 'patronymic', label: 'Отчество', sortable: true, sortDirection: 'desc',class: 'text-center' },
                    { key: 'subject', label: 'Предмет', sortable: true, sortDirection: 'desc',class: 'text-center' },
                    { key: 'actions', label: 'Действия' }

                ],
            }
        },
    }
</script>

<style scoped>

</style>
