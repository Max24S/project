<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform" xmlns="http://www.w3.org/1999/html">
    <div>
        <table-admin :items="subjects" :fields="fields" :routes="routes">
            <template slot="link">
<div>
<h1>kll;lkj;k</h1>
            </div>
            </template>
        </table-admin>

    </div>
</template>

<script>
    export default {
        name:'IndexSubject',
        props:['subjects'],
        data() {
            return {
                routes:{
                    Create:'/admin/super/subject/create',
                    Edit:'/admin/super/subject/',
                    Delete:'/admin/super/subject/'
                },
                fields: [
                    { key: 'id', label: 'id', sortable: true, class: 'text-center' },
                    { key: 'name', label: 'Имя', sortable: true, class: 'text-center' },
                    { key: 'actions', label: 'Действия' }
                ],
            }
        },
    }
</script>

<style scoped>

</style>
