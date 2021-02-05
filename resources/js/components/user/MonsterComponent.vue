<template>
    <div class="monster">
    </div>
</template>

<script>
    export default {
        props: ['monster'],
        data: function(){
            return {
            }
        }
    }
</script>

<style lang="scss">
    .monster {
        position: absolute;
        top: 20px;
        left: 20px;
        width: 50px;
        height: 50px;
        background-color: #863;
        float: left;
    }
    .dbg {
        background: #814;
        margin-left: 100px;
        color: black;
    }
</style>
