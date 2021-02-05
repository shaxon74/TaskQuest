<template>
    <div class="my-menu">
        <!-- <p>Activated!!</p> -->
        <button v-on:click="closingButton">close</button>
    </div>
</template>

<script>
export default {
    props: ['is_active'],
    data: function(){
        return {
            visibility: 'visibility: visible;'
        }
    },
    methods: {
        closingButton: function() {
            console.log("myClick emitted!")
            this.$emit('myMenuIsClosed','');
        }
    }
}
</script>

<style lang="scss">
    .my-menu {
        position: absolute;
        float: left;
        width: 300px;
        height: 300px;
        border: solid;
        background-color: #ccc;
        p {
            color: black;
        }
        button {
            margin-left: 20px;
        }
    }
</style>
