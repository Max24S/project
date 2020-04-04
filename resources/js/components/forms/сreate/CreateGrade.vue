<template>
    <form class="form-horizontal" role="form">
        <h2>Добавление класса</h2>
        <div class="form-group">
            <div class="row">
                <label for="Name" class="col-sm-4 control-label">Название класса</label>
                <div class="col-sm-8">
                    <input type="text" id="Name" placeholder="Класс..." class="form-control" autofocus>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <label>Укажите руководителя</label>
            </div>
            <div class="form-group col-sm-6">
                <select id="inputStaff" class="form-control">
                    <option selected></option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <label>Укажите кабинет</label>
            </div>
            <div class="form-group col-sm-6">
                <select id="inputClassroom" class="form-control">
                    <option selected></option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Добавить</button>
    </form>
</template>

<script>
    export default {
        name: "CreateGrade"
    }
</script>

<style scoped>

</style>
