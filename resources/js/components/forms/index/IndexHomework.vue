<template>
    <div>
        <div class="container-fluid">
            <form method="get" @submit.prevent="SendData">
                <div class="form-container">
                    <div class="row">
                        <div class="col-5">
                            <select class="form-control input" v-model="timetableData.grade_id"  name="grade"
                                    v-validate="'required|excluded:none|integer'"
                                    :class="{'input': true, 'alert-danger':errors.has('grade')}">
                                <option value="none">Выберите класс</option>
                                <option v-for="grade in teachersAndSubjects['grades']" :value="grade.id">{{grade.name}}</option>
                            </select>
                            <span v-if="errors.has('grade')" class="help is-danger">{{ errors.first('grade') }}</span>
                        </div>
                        <div class="col-5">
                            <select class="form-control input" v-model="timetableData.semester" name="semester"
                                    v-validate="'required|excluded:none|integer'"
                                    :class="{'input': true, 'alert-danger':errors.has('semester')}">
                                <option value="none">Выберите семестр</option>
                                <option >1</option>
                                <option>2</option>
                            </select>
                            <span v-if="errors.has('semester')" class="help is-danger">{{ errors.first('semester') }}</span>
                        </div>
                        <div class="col-2">
                            <b-button  variant="info" type="submit">Выбрать</b-button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "IndexHomework"
    }
    props:['teachers-and-subjects','params'],
</script>

<style scoped>

</style>