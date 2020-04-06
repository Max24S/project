<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <b-container fluid>
        <!-- Main table element -->
        <b-row>
            <b-col md="8" lg="6" class="my-1">
                <b-form-group class="mb-0">
                    <b-input-group size="sm">
                        <b-form-input
                            v-model="filter"
                            type="search"
                            id="filterInput"
                            placeholder="Поиск"
                        >
                        </b-form-input>
                        <b-input-group-append>
                            <b-button :disabled="!filter" @click="filter = ''" class="bg-info">Очистить</b-button>
                        </b-input-group-append>
                    </b-input-group>
                </b-form-group>
            </b-col>
        </b-row>

        <b-table
            show-empty
            small
            stacked="lg"
            :items="users"
            :fields="fields"
            :current-page="currentPage"
            :per-page="perPage"
            :filter="filter"
            :filterIncludedFields="filterOn"
            :sort-by.sync="sortBy"
            :sort-desc.sync="sortDesc"
            :sort-direction="sortDirection"
            @filtered="onFiltered"
            bordered
        >
            <!--<template v-slot:cell(users)="row">-->
                <!--{{ row.value.name }} {{ row.value.surname }}-->
            <!--</template>-->

            <template v-slot:cell(actions)="row">
                <b-button  size="sm" @click="info(row.item, row.index, $event.target)" class="mr-1 bg-primary">
                    Редактировать
                </b-button>
                <b-button size="sm" @click="" class="bg-danger">
                    Удалить
                </b-button>
            </template>

            <template v-slot:row-details="row">
                <b-card>
                    <ul>
                        <li v-for="(value, key) in row.item" :key="key">{{ key }}: {{ value }}</li>
                    </ul>
                </b-card>
            </template>
        </b-table>

        <!-- Info modal -->
        <b-modal :id="infoModal.id" :title="infoModal.title" ok-only @hide="resetInfoModal">
            <pre>{{ infoModal.content }}</pre>
        </b-modal>
        <!-- User Interface controls -->
        <b-row>

            <b-col sm="12" md="6" class="my-1">
                <b-form-group
                    label="Выводить по"
                    label-cols-sm="6"
                    label-cols-md="4"
                    label-cols-lg="3"
                    label-align-sm="left"
                    label-size="sm"
                    label-for="perPageSelect"
                    class="mb-0"
                >
                    <b-form-select
                        sm="6"
                        text-align-sm="left"
                        v-model="perPage"
                        id="perPageSelect"
                        size="sm"
                        :options="pageOptions"
                    ></b-form-select>
                </b-form-group>
            </b-col>

            <b-col sm="12" md="6" class="my-1">
                <b-pagination
                    v-model="currentPage"
                    :total-rows="totalRows"
                    :per-page="perPage"
                    align="fill"
                    size="sm"
                    class="my-0"
                ></b-pagination>
            </b-col>
        </b-row>

    </b-container>
</template>

<script>
    export default {
        props:['users'],
        data() {
            return {
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
                totalRows: 1,
                currentPage: 1,
                perPage: 10,
                pageOptions: [5, 10, 15],
                sortBy: '',
                sortDesc: false,
                sortDirection: 'asc',
                filter: null,
                filterOn: [],
                infoModal: {
                    id: 'info-modal',
                    title: '',
                    content: ''
                }
            }
        },
        computed: {

        },
        mounted() {
            // Set the initial number of items
            this.totalRows = this.users.length
        },
        methods: {
            info(item, index, button) {
                this.infoModal.title = `Row index: ${index}`
                this.infoModal.content = JSON.stringify(item, null, 2)
                this.$root.$emit('bv::show::modal', this.infoModal.id, button)
            },
            resetInfoModal() {
                this.infoModal.title = ''
                this.infoModal.content = ''
            },
            // onFiltered(filteredItems) {
            //     // Trigger pagination to update the number of buttons/pages due to filtering
            //     this.totalRows = filteredItems.length
            //     this.currentPage = 1
            // }
        }
    }
</script>

<!--<template>-->

     <!--<div>-->
         <!--<div>-->
             <!--<b-table striped hover :items="items"></b-table>-->
         <!--</div>-->
         <!--<vue-virtual-table-->
             <!--:config="tableConfig"-->
             <!--:data="users"-->
             <!--:height="500"-->
             <!--:itemHeight="55"-->
             <!--:minWidth="1400"-->
             <!--:selectable="true"-->
             <!--:enableExport="true"-->
         <!--&gt;-->

         <!--</vue-virtual-table>-->
     <!--</div>-->
<!--</template>-->

<!--<script>-->

    <!--import VueVirtualTable from 'vue-virtual-table'-->


    <!--export default {-->
        <!--components: {-->
          <!--VueVirtualTable-->
        <!--},-->
        <!--name: "IndexUser",-->
        <!--props:['users'],-->
        <!--data() {-->
            <!--return {-->
                <!--tableConfig: [-->
                    <!--{prop: 'id'},-->
                    <!--{prop: 'name'},-->
                    <!--{prop: 'surname'},-->
                    <!--{prop: 'patronymic'},-->
                    <!--{prop: 'email'},-->
                    <!--{prop: 'email_verified_at'},-->
                    <!--{prop: 'number'},-->
                    <!--{prop: 'address'},-->
                    <!--{prop: 'birthday'},-->
                    <!--{prop: 'sex'},-->
                    <!--{prop: 'role'}-->
                <!--],-->
                <!--items: [-->
                    <!--{ age: 40, first_name: 'Dickerson', last_name: 'Macdonald' },-->
                    <!--{ age: 21, first_name: 'Larsen', last_name: 'Shaw' },-->
                    <!--{ age: 89, first_name: 'Geneva', last_name: 'Wilson' },-->
                    <!--{ age: 38, first_name: 'Jami', last_name: 'Carney' }-->
                <!--]-->
            <!--}-->
        <!--}-->
    <!--}-->
<!--</script>-->

<!--<style scoped>-->

<!--</style>-->
