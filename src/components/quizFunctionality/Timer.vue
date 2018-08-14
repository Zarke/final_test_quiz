<template>
    <div class="row justify-content-center mb-3">
        <span class="font-weight-bold">{{time}} </span>
        <slot></slot>
    </div>
</template>

<script>
import { eventBus } from '../../main';

export default {
    data: function(){
        return{
            time: '',
            startingTime: '',
            currTime: '',
            counter:0
        };
    },
    methods:  {
        
        elapsedTime(){
            var timer = setInterval(function(){
                let minutes = Math.floor(this.counter/60);
                if (minutes > 0){ minutes = minutes-1};
            this.time = this.$moment().minute(minutes).second(this.counter++).format('mm:ss');
        }.bind(this),1000);
        }
    },
    created(){
        this.elapsedTime();
        this.$store.commit('updateUser', {
                    key: 'date',
                    value: this.$moment.utc().format()
                })       
    },
    beforeDestroy(){
        this.$store.commit('updateUser', {
                    key: 'time',
                    value: this.time
        })
        // this.$emit('totalTime', ['time', this.time]);
    }
}
</script>

<style>
</style>
