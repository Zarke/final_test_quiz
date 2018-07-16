<template>
    <div class="row">
       <div class="col-sm-12">
            <button @click="restartQuiz()">Restart Quiz</button>
        </div>
    </div>
</template>

<script>
     import { eventBus } from '../../main';

    export default {
        methods: {
            restartQuiz(){
                this.$emit('quizFinished', true);
            }
        }
    }
</script>

<style>
</style>
