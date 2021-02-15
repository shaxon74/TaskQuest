<template>
    <div class="monster-menu" :style="visibility">
        <button v-on:click="this.switch" class="button-close">
            <div class="cross"></div>
        </button>
        <p>Activated!!</p>
    </div>
</template>

<script>
export default {
    data: function(){
        return {
            is_active: false,
            visibility: 'visibility: hidden;'
        }
    },
    methods: {
        switch: function() {
            this.is_active = !this.is_active;
            this.switchStyle(this.is_active);
        },
        switchStyle: function(isActive){
            this.visibility = isActive ?
                'visibility: visible; ' : 'visibility: hidden; '
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
        height: 150px;
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
