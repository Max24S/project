<template>
    <button @click="hide()">{{content}}</button>
</template>

<script>
    export default {
        name: "comH",
        props:['content'],
        data(){
            return {
                visible:true
            }
        },
        methods:{
            hide() {

                this.visible=!this.visible;
                this.$emit('hide', this.visible)
            }
        }
    }
</script>

<style scoped>

</style>
