<template>
    <div>
        <form method="get" @submit.prevent="SendData">
        <select v-model="timetableData.grade_id"  name="grade">
            <option value="none">Выберите класс</option>
            <option v-for="grade in grades" :value="grade.id">{{grade.name}}</option>
        </select>
        <select v-model="timetableData.semester" name="semectr">
            <option value="none">Выберите семестр</option>
            <option>1</option>
            <option>2</option>
        </select>
        <input type="submit">
    </form>
    <b-container fluid >
        <!-- User Interface controls -->
        <b-row>
            <b-col lg="6" class="my-1">
                <b-form-group
                    label="Filter"
                    label-cols-sm="3"
                    label-align-sm="right"
                    label-size="sm"
                    label-for="filterInput"
                    class="mb-0"
                >
                    <b-input-group size="sm">
                        <b-form-input
                            v-model="filter"
                            type="search"
                            id="filterInput"
                            placeholder="Type to Search"
                        ></b-form-input>
                        <b-input-group-append>
                            <b-button :disabled="!filter" @click="filter = ''">Clear</b-button>
                        </b-input-group-append>
                    </b-input-group>
                </b-form-group>
            </b-col>

            <b-col sm="5" md="6" class="my-1">
                <b-form-group
                    label="Per page"
                    label-cols-sm="6"
                    label-cols-md="4"
                    label-cols-lg="3"
                    label-align-sm="right"
                    label-size="sm"
                    label-for="perPageSelect"
                    class="mb-0"
                >
                    <b-form-select
                        v-model="perPage"
                        id="perPageSelect"
                        size="sm"
                        :options="pageOptions"
                    ></b-form-select>
                </b-form-group>
            </b-col>

            <b-col sm="7" md="6" class="my-1">
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

        <!-- Main table element -->
        <b-table
            bordered
            show-empty
            small
            stacked="md"
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
        >
            <template v-slot:cell(monday)="row">
                <a :href="'timetable/'+row.value.id+'/edit'">{{ row.value.subjects }}</a>
            </template>
            <template v-slot:cell(tuesday)="row">
                {{ row.value.subjects }}
            </template>
            <template v-slot:cell(wednesday)="row">
                {{ row.value.subjects }}
            </template>
            <template v-slot:cell(thursday)="row">
                {{ row.value.subjects }}
            </template>
            <template v-slot:cell(friday)="row">
                {{ row.value.subjects }}
            </template>
            <template v-slot:cell(saturday)="row">
                {{ row.value.subjects }}
            </template>
            <template v-slot:cell(actions)="row">
                <b-button size="sm" @click="info(row.item, row.index, $event.target)" class="mr-1">
                    Info modal
                </b-button>
                <b-button size="sm" @click="row.toggleDetails">
                    {{ row.detailsShowing ? 'Hide' : 'Show' }} Details
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
    </b-container>
    </div>
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

                days:['Понедельник','Вторник','Среда','Четверг','Пятница','Суббота'],
                items: [
            ]
                ,
            monday:{},
                isVisible:"",
                fields: [
                    { key: 'lesson', label: '№ урока' },
                    { key: 'monday', label: 'Понедельник' },
                    { key: 'tuesday', label: 'Вторник' },
                    { key: 'wednesday', label: 'Среда' },
                    { key: 'thursday', label: 'Четверг' },
                    { key: 'friday', label: 'Пятница' },
                    { key: 'saturday', label: 'Суббота' },
                ],
                totalRows: 1,
                currentPage: 1,
                perPage: 8,
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
        methods:{
            SendData(){
                this.$validator.validateAll().then((result) => {
                    if (true) {
                        axios.post(window.routes['admin.teacher.head-teacher.timetable.indexTimetable'], this.timetableData)
                            .then((response) => {
                                if (response.data.result=='OK') {
                                    this.items=response.data.timetable;

                                    this.isVisible=1;
                                    console.log(this.items);
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
            },

            info(item, index, button) {
                this.infoModal.title = `Row index: ${index}`
                this.infoModal.content = JSON.stringify(item, null, 2)
                this.$root.$emit('bv::show::modal', this.infoModal.id, button)
            },
            resetInfoModal() {
                this.infoModal.title = ''
                this.infoModal.content = ''
            },
            onFiltered(filteredItems) {
                // Trigger pagination to update the number of buttons/pages due to filtering
                this.totalRows = filteredItems.length
                this.currentPage = 1
            }
        },
        computed: {
            sortOptions() {
                // Create an options list from our fields
                return this.fields
                    .filter(f => f.sortable)
                    .map(f => {
                        return { text: f.label, value: f.key }
                    })
            }
        },
        mounted() {
            this.totalRows = this.items.length
        },
    }
</script>

<style scoped>
    form {
        margin-top:53px;
    }
</style>
