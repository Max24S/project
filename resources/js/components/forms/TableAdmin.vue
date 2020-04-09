<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform" xmlns="http://www.w3.org/1999/html">
    <div>
        <b-container fluid>
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
                                <b-button
                                    :disabled="!filter"
                                    @click="filter = ''"
                                    class="bg-info"
                                >
                                    Очистить
                                </b-button>
                            </b-input-group-append>
                        </b-input-group>
                    </b-form-group>
                </b-col>
                <b-col md="4" lg="6">
                    <b-form-group class="mb-0">
                        <a v-if="routes.Create" :href="routes.Create">Добавить</a>
                    </b-form-group>
                </b-col>
            </b-row>
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
            >
                <template v-slot:cell(actions)="row">
                    <a v-if="routes.Edit" :href="routes.Edit+row.item.id+'/edit'">Редактировать</a>
                    <b-button
                        @click="showMsgBoxDelete(row.item.id,row.index)"
                        size="sm"
                        class="bg-danger">
                        Удалить
                    </b-button>
                    <template v-if="action">
                        <a :href="action.route+row.item.id+'/'+row.item.name">{{action.content}}</a>
                    </template>
                </template>
            </b-table>
            <b-row>
                <b-col sm="12" md="6" class="my-1">
                    <b-pagination
                        v-model="currentPage"
                        :total-rows="totalRows"
                        :per-page="perPage"
                        align="fill"
                        size="sm"
                        class="my-0"
                    >
                    </b-pagination>
                </b-col>
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
                        >
                        </b-form-select>
                    </b-form-group>
                </b-col>
            </b-row>
        </b-container>
    </div>
</template>

<script>
    export default {
        name:'TableAdmin',
        props:['routes','fields','items','action'],
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

            }
        },
        mounted() {
            console.log(this.$refs.table.items)
            // Set the initial number of items

            this.totalRows = this.items.length
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
                    .then(value => {

                        if (value){

                            axios.delete(this.routes.Delete+id).then((response) =>{
                                console.log(this.routes.Delete+id);
                                if(response.data.response=='deleted')
                                {
                                    this.$delete(this.$refs.table.items,index);
                                    this.$refs.table.refresh();

                                    this.$toaster.success("Запись успешно удалена");

                                }

                            }).catch(e => {
                                this.$toaster.error("Пользователь не найден");

                            });
                        }
                    })
                    .catch(err => {

                    })
            },
            onFiltered(filteredItems) {
                // Trigger pagination to update the number of buttons/pages due to filtering
                this.totalRows = filteredItems.length
                this.currentPage = 1
            }
        }
    }
</script>

<style scoped>
</style>
