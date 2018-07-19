<template>
    <div class="row justify-content-center mb-3">
        <span class="font-weight-bold">{{counter}} </span>
        <slot></slot>
    </div>
</template>

<script>
import { eventBus } from '../../main';

export default {
    props: {
        quizFinished: Boolean
    },
    data: function(){
        return{
            counter: '',
            startingTime: '',
            currTime: ''
        };
    },
    methods:  {
        elapsedTime(){
            var timer = setInterval(function(){
            this.currTime = this.$moment();
            this.counter = this.currTime.diff(this.startingTime, 'seconds');
        }.bind(this),1000);
        }
    },
    created(){
        this.elapsedTime();
        this.startingTime = this.$moment();
    },
    beforeDestroy(){
        this.$emit('totalTime', ['totalTime',this.counter]);
    }
}
</script>

<style>
</style>
