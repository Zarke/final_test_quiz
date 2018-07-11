<template>
    <div class="row justify-content-center mb-3">
        <span><b>Your time: {{ counter }}</b></span>
    </div>
</template>

<script>
import { eventBus } from '../main';

export default {
    props: {
        quizFinished: Boolean
    },
    data: function(){
        return{
            counter: '00:00',
            startingTime: ''
        };
    },
    methods:  {
        timeFormatting(minutes,seconds){
            if (minutes < 10 && seconds < 10){
                this.counter = '0'+minutes+':'+'0'+seconds;
            } else if(minutes < 10 && seconds >= 10){
                this.counter = '0'+minutes+':'+seconds;
            } else if(minutes > 10 && seconds >10){
                this.counter = minutes+':'+seconds;
            } else if(minutes > 10 && seconds < 10){
                this.counter = minutes+':'+'0'+seconds;
            }  
        },
        elapsedTime(){
            var timer = setInterval(function(){
                if(this.quizFinished){
                    clearInterval(timer);
                } else{
                    var currDate = new Date;
                    var currTime = currDate.getTime();
                    var minutes = Math.floor((currTime - this.startingTime) / 60000);
                    var seconds = (((currTime - this.startingTime) % 60000) / 1000).toFixed(0);
                    this.timeFormatting(minutes, seconds);
                }
                
        }.bind(this),1000);
        }
    },
    created(){
        this.startingTime = new Date;//the time when the user has started the quiz 
        this.startingTime = this.startingTime.getTime();
        this.elapsedTime();

    }
}
</script>

<style>
</style>
