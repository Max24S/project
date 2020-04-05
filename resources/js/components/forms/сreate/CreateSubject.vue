<template>
    <div class="container">
        <form class="form-horizontal" role="form">
            <h2>Добавление предмета</h2>
            <div class="form-group">
                <div class="row">
                    <label for="Name" class="col-sm-4 control-label">Название предмета</label>
                    <div class="col-sm-8">
                        <input type="text" id="Name" placeholder="Предмет..." class="form-control" autofocus>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-6">
                <select id="inputState" class="form-control" >
                    <option selected>Выбор преподавателей</option>
                    <option>3</option>
                    <option>1</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Добавить</button>
        </form>
    </div>

</template>

<script>
    export default {
        name: "CreateSubject"
    }
    // computed: {
    //     resultQuery(){
    //         if(this.searchQuery){
    //             return this.users.filter((item)=>{
    //                 return this.searchQuery.toLowerCase().split(' ').every(v => item.name.toLowerCase().includes(v))
    //             })
    //         }else{
    //             return this.users;
    //         }
    //     },
    //     selectetTeacher(){
    //         if(this.test1){
    //
    //             this.searchQuery = this.test1;
    //         }
    //     }
    // }
    // selectetTeachers(){
    //
    //
    //     if(this.selected.indexOf(this.test1)==-1&&this.test1){
    //
    //         this.selected.push(this.test1);
    //     }
    //     console.log(this.selected.length)
    //     return this.selected;
    // }
</script>

<style scoped>

</style>
