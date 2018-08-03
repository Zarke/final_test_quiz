<template>
    <div class="row">
       <div class="col-sm-12">
            <button @click="updateResults"></button>
            <button @click="restartQuiz()">Restart Quiz</button>
        </div>
    </div>
</template>

<script>
     import { eventBus } from '../../main';

    export default {
        props: {
            result: Object
        },
        methods: {
            restartQuiz(){
                this.$emit('quizFinished', true);
            },


        }
    }
</script>

<style>
</style>
