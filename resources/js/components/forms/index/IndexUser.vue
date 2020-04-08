<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform" xmlns="http://www.w3.org/1999/html">

    <table-admin :items="users" :fields="fields" :routes="routes"></table-admin>

</template>

<script>
    export default {
        props:['users'],
        data() {
            return {
                routes:{
                    Create:'/admin/super/user/create',
                    Edit:'/admin/super/user/',
                    Delete:'/admin/super/user/'
                },
                fields: [
                    { key: 'id', label: 'id', sortable: true, class: 'text-center' },
                    { key: 'name', label: 'Имя', sortable: true, class: 'text-center' },
                    { key: 'surname', label: 'фамилия', sortable: true, sortDirection: 'desc' },
                    { key: 'patronymic', label: 'Отчество', sortable: true, sortDirection: 'desc' },
                    { key: 'email', label: 'email', sortable: true, sortDirection: 'desc' },
                    { key: 'number', label: 'Номер телефона', sortable: true, sortDirection: 'desc' },
                    { key: 'address', label: 'Адресс', sortable: true, sortDirection: 'desc' },
                    { key: 'birthday', label: 'Дата рождения', sortable: true, sortDirection: 'desc' },
                    { key: 'sex', label: 'Пол', sortable: true, sortDirection: 'desc' },
                    { key: 'role', label: 'Роль', sortable: true, sortDirection: 'desc' },
                    { key: 'actions', label: 'Действия' }

                ],
            }
        },
    }
</script>

<style scoped>

</style>
