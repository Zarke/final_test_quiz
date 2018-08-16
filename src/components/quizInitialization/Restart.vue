<template>
    <div class="row">
       <div class="col-sm-12">
            <button @click="uploadResult">Submit your results</button>
            <button @click="restartQuiz">Restart Quiz</button>
        </div>
    </div>
</template>

<script>
     import { eventBus } from '../../main';

    export default {
        methods: {
            restartQuiz(){
                this.$store.commit('quizStateChange', {
                    start: false,
                    end: false
                })
                this.$store.commit('userInfoReset', true);
            },
            uploadResult() {
                eventBus.$emit('uploadResult', true);
            }
        }
    }
</script>

<style>
</style>
