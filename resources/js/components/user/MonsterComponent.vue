<template>
    <div class="monster" :style="style">
        <button v-on:click="this.switchMonsterMenu">open</button>
        <monstermenu-component
            ref="monsterMenu"
            :monster="monster"
            :doneTask="doneTask">
        </monstermenu-component>
    </div>
</template>

<script>
export default {
    props: ['monster', 'doneTasks'],
    data: function(){
        return {
            style: '',
            doneTask: []
        }
    },
    mounted: function(){
        this.setStyle();
        this.setDoneTask();
    },
    methods: {
        setStyle: function(){
            let dayjs = require('dayjs');   // day.jsライブラリの呼出し
            let positionLeft = 40
                + this.monster.dateLimit.diff(dayjs().subtract(1,'day'), 'day') * 100
                + Math.floor((this.monster.numPerDay)/5, 0) * 20
                - this.monster.numPerDay * 5;
            let positionTop = 100
                + this.monster.numPerDay % 5  * 40;
            let styleLeft = 'left: ' + positionLeft + 'px;';
            let styleTop  = 'top: '  + positionTop  + 'px;';
            this.style = styleLeft + styleTop;
        },
        switchMonsterMenu: function(){
            this.$refs.monsterMenu.switchVisibility();
        },
        setDoneTask: function(){
            // console.log(this.doneTasks[0][1]);
            // console.log('id: ' + this.monster.id);
            this.doneTask = this.doneTasks.filter(item =>
                // item.date_limit === this.monster.dateLimit
                // &&
                item.tasks_id === 1
            );
            // console.log(this.doneTask);
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
