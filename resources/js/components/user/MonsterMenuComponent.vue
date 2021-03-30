<template>
    <div class="monster-menu" :style="visibility">
        <button v-on:click="this.switchVisibility" class="button-close">
            <div class="cross"></div>
        </button>
        <button v-on:click="this.switchDone">
            Done
        </button>
        <p>Name: {{ this.monster.name }}</p>
        <p>reword: {{ this.monster.reword }}</p>
        <p>dateLimit: {{ this.monster.dateLimit.format('YYYY-MM-DD') }}</p>
        <p v-if="this.monster.isDone">done: true</p>
        <p v-if="!this.monster.isDone">done: false</p>
    </div>
</template>

<script>
export default {
    props: ['monster'],
    data: function(){
        return {
            isActive: false,
            visibility: 'visibility: hidden;',
            axiosData: {
                taskId: this.monster.taskId,
                dateLimit: this.monster.dateLimit.format('YYYY-MM-DD')
            },
        }
    },
    methods: {
        switchVisibility: function(isHovered) {
            this.visibility = isHovered ?
            'visibility: visible;' : 'visibility: hidden;'
        },
        switchDone: async function() {
            await axios.post('/done_task', this.axiosData)
            .then(response => {
                this.monster.isDone = response.data.isDone;
            }).catch(error => {
            });
        }
    }
}
</script>

<style lang="scss">
    .monster-menu {
        position: relative;
        top: -100px;
        left: 50px;
        width: 200px;
        // height: 150px;
        border: solid;
        z-index:10000;
        background-color: #ccc;
        p {
            color: black;
        }
        .button-close {
            position: absolute;
            top: -1px;
            left: 165px;
            width: 30px;
            height: 30px;
        }
        .cross{
        	margin: auto;
        	position: relative;
        	width: 4px; /* 縦棒の幅 */
        	height: 20px; /* 縦棒の長さ */
        	background: #C34; /* 縦棒の色 */
            transform: rotate(-45deg); /* 角度 */
        }
        .cross::after {
        	content: "";
        	position: absolute;
        	top: -0px; /* 横棒のy位置 */
        	left: -0px; /* 横棒のX位置 */
        	width: 4px; /* 横棒の長さ */
            height: 20px; /* 横棒の幅 */
        	background: #C34; /* 横棒の色 */
            transform: rotate(-90deg); /* 角度 */
        }
    }
</style>
