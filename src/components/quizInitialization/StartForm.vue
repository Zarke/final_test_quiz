<template>
    <div class="row">
        <div class="form-group">
            <label for="name" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-10">
                <input type="text" id="name">
            </div>
            <button @click="beginQuiz()">Start Quiz</button>
        </div>
        
    </div>
</template>

<script>
     import { eventBus } from '../../main';

    export default {
        methods: {
            beginQuiz(){
                this.start = !this.start;
                this.end = false;
                this.$emit('quizStarted', this.start);
                this.$emit('quizEndChange', false)
            }

        }
    }
</script>

<style>
</style>
