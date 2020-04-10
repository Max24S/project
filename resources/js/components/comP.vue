<template>
    <div>
        <span v-if="visible">Hello</span>
        <com-h :content="content" @hide="visible=$event"></com-h>
        <input type="text" v-model="content">
    </div>
</template>

<script>
    export default {
        name: "comP",
        data(){
            return {
                visible:true,
                content:'button'
            }
        }
    }
</script>

<style scoped>

</style>
