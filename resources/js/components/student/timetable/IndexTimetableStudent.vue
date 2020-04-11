<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform" xmlns="http://www.w3.org/1999/html">
    <div>
        <b-container fluid>
            <b-table
                show-empty
                small
                stacked="lg"
                :items="items"
                :fields="fields"
                :current-page="currentPage"
                :per-page="perPage"
                :filter="filter"
                :filterIncludedFields="filterOn"
                :sort-by.sync="sortBy"
                :sort-desc.sync="sortDesc"
                :sort-direction="sortDirection"
                @filtered="onFiltered"
                ref="table"
                bordered
                class="mb-0 table"
            >
                <template v-slot:thead-top="data">
                    <b-tr>
                        <b-th></b-th>
                        <b-th v-for="date in dateNow">{{date}}</b-th>
                    </b-tr>
                </template>
                <template v-slot:cell(actions)="row">
                    <a
                        class="btn btn-primary edit"
                        v-if="routes.Edit"
                        :href="routes.Edit+row.item.id+'/edit'"
                    >
                        Редактировать
                    </a>
                    <template v-if="action">
                        <a class="btn btn-info edit" :href="action.route+row.item.id+'/'+row.item.name">{{action.content}}</a>
                    </template>
                    <b-button
                        @click="showMsgBoxDelete(row.item.id,row.index)"
                        size="sm"
                        class="btn btn-danger">
                        Удалить
                    </b-button>
                </template>
            </b-table>
        </b-container>
    </div>
</template>

<script>
    export default {
        name:'TableAdmin',
        // props:['routes','fields','items','action','form-create'],
        data() {
            return {
                totalRows: 1,
                currentPage: 1,
                perPage: 10,
                pageOptions: [5, 10, 15],
                sortBy: '',
                sortDesc: false,
                sortDirection: 'asc',
                filter: null,
                filterOn: [],
                items:[
                    {lesson:1,monday:"",tuesday:"",wednesday:"",thursday:"",friday:"",saturday:''},
                    {lesson:2,monday:"",tuesday:"",wednesday:"",thursday:"",friday:"",saturday:''},
                    {lesson:3,monday:"",tuesday:"",wednesday:"",thursday:"",friday:"",saturday:''},
                    {lesson:4,monday:"",tuesday:"",wednesday:"",thursday:"",friday:"",saturday:''},
                    {lesson:5,monday:"",tuesday:"",wednesday:"",thursday:"",friday:"",saturday:''},
                    {lesson:6,monday:"",tuesday:"",wednesday:"",thursday:"",friday:"",saturday:''},
                    {lesson:7,monday:"",tuesday:"",wednesday:"",thursday:"",friday:"",saturday:''},
                    {lesson:8,monday:"",tuesday:"",wednesday:"",thursday:"",friday:"",saturday:''}
                    ],
                fields:[
                    {key:'lesson',label:'№ Урока'},
                    {key:'monday',label: 'Понедельник'},
                    {key:'tuesday',label: 'Вторник'},
                    {key:'wednesday',label: 'Среда'},
                    {key:'thursday',label: 'Четверг'},
                    {key:'friday',label: 'Пятница'},
                    {key:'saturday',label: 'Суббота'},
                    ],
                routes:{},
                dateNow:[]
            }
        },
        mounted() {
            console.log(this.$refs.table.items)
            this.totalRows = this.items.length
            this.getNow();
        },
        methods: {
            showMsgBoxDelete(id, index) {

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

                    .catch(err => {

                    })
            },
            onFiltered(filteredItems) {
                // Trigger pagination to update the number of buttons/pages due to filtering
                this.totalRows = filteredItems.length
                this.currentPage = 1
            },
            getNow() {
               let nowDate = new Date();
               if(nowDate.getDay()){
                   nowDate.setDate(nowDate.getDate() - nowDate.getDay());
               }
                for(let i=1;i<7;i++){
                    let param =new Date(nowDate.setDate(nowDate.getDate()+1))

                    let day = param.getDate()<10?'0'+param.getDate():param.getDate();
                    let month = param.getMonth()+1<10?'0'+(param.getMonth()+1):param.getMonth()+1;
                    let year = param.getFullYear();

                    this.dateNow.push(day+"."+month+"."+year)
                }
            }
        },
    }
</script>

<style scoped>
    .edit {
        padding: 4px 8px;
        font-size: 14px;
    }
    .perPageSelect {
        max-width:100px;
    }
</style>
