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
    import { mapActions } from 'vuex';
    import * as types from '../../store/types';

    export default {
        methods: {
            ...mapActions({
                quizStateChange: types.ACTION_QUIZ_STATE_CHANGE,
                userInfoReset: types.ACTION_USER_RESET
            }),
            restartQuiz(){
                this.quizStateChange({
                    start: false,
                    end: false
                })
                this.userInfoReset(true);
            },
            uploadResult() {
                eventBus.$emit('uploadResult', true);
            }
        }
    }
</script>

<style>
</style>
