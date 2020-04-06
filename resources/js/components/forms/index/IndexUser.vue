<template>
     <div>

         <vue-virtual-table
             :config="tableConfig"
             :data="users"
             :height="500"
             :itemHeight="55"
             :minWidth="1400"
             :selectable="true"
             :enableExport="true"
         >

         </vue-virtual-table>
     </div>
</template>

<script>
    import { DataTable } from 'v-datatable-light';
    import VueVirtualTable from 'vue-virtual-table'


    export default {
        components: {
            DataTable,VueVirtualTable
        },
        name: "IndexUser",
        props:['users'],
        data() {
            return {
                tableConfig: [
                    {prop: 'id'},
                    {prop: 'name'},
                    {prop: 'surname'},
                    {prop: 'patronymic'},
                    {prop: 'email'},
                    {prop: 'email_verified_at'},
                    {prop: 'number'},
                    {prop: 'address'},
                    {prop: 'birthday'},
                    {prop: 'sex'},
                    {prop: 'role'}
                ],
                tableData: [
                    {user: 'a1', age: 20,user1: 'a1', age1: 20},
                        {user: 'a1', age: 20,user1: 'a1', age1: 20},
                        {user: 'a1', age: 20,user1: 'a1', age1: 20},
                        {user: 'a1', age: 20,user1: 'a1', age1: 20},
                        {user: 'a1', age: 20,user1: 'a1', age1: 20},
                        {user: 'a1', age: 20,user1: 'a1', age1: 20},
                ]
            }
        }
    }
</script>

<style scoped>

</style>
