<template>
    <div class="monster" :style="style">
        <button v-on:click="this.switchMonsterMenu">open</button>
        <monstermenu-component
            ref="monsterMenu"
            :monster="monster">
        </monstermenu-component>
    </div>
</template>

<script>
export default {
    props: ['monster'],
    data: function(){
        return {
            style: '',
        }
    },
    mounted: function(){
        this.setStyle();
    },
    methods: {
        setStyle: function(){
            let dayjs = require('dayjs');   // day.jsライブラリの呼出し
            let positionLeft = 40
                + this.monster.dateLimit.diff(dayjs().subtract(1,'day'), 'day') * 120
                + Math.floor((this.monster.numPerDay)/5, 0) * 60
                - this.monster.numPerDay * 5;
            let positionTop = 100
                + this.monster.numPerDay % 5  * 40
                + Math.floor((this.monster.numPerDay)/5, 0) * 10;
            let styleLeft = 'left: ' + positionLeft + 'px;';
            let styleTop  = 'top: '  + positionTop  + 'px;';
            this.style    = styleLeft + styleTop;
        },
        switchMonsterMenu: function(){
            this.$refs.monsterMenu.switchVisibility();
        }
    }
}
</script>

<style lang="scss">
    .monster {
        position: absolute;
        top: 0px;
        left: 0px;
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
