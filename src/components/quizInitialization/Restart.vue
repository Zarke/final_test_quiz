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
    import { mapMutations } from 'vuex';

    export default {
        methods: {
            ...mapMutations([
                'quizStateChange',
                'updateUser'
            ]),
            restartQuiz(){
                this.quizStateChange({
                    start: false,
                    end: false
                })
                this.userInfoChange(true);
            },
            uploadResult() {
                eventBus.$emit('uploadResult', true);
            }
        }
    }
</script>

<style>
</style>
