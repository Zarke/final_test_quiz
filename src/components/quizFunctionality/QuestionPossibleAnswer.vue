<template>
    <div id="answer" @click="answerSelected">
        {{dataAnswer}}
    </div>
</template>

<script>
    import { eventBus } from '../../main';

    export default {
        props:{
            answer: String
        },
        data:function(){
            return{
                dataAnswer: this.answer
            }
        },
        watch:{
            answer: function(){
                this.dataAnswer = this.answer;
            }
        },
        methods: {
            answerSelected(){
                eventBus.$emit('answerSelected',this.dataAnswer);
            }
        }
    }
</script>

<style>
#answer{
    text-align: center;
}
</style>
