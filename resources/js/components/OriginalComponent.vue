<template>
   <div class="container">
       <strong>Success!</strong> {{ message }}
       <button v-on:click="reverseMessage">Reverse Message</button>
   </div>
</template>

<script>
    export default {
        name:'original-component',
        data() {
            return {
                message: 'Hello World!'
                // message: 'Changed!'
            }
        },
        methods: {
            reverseMessage: function () {
                this.message = this.message.split('').reverse().join('')
            }
        }
    }
</script>
