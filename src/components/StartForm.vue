<template>
    <div class="row">
        <div class="form-group" v-if="!start">
            <label for="name" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-10">
                <input type="text" id="name">
            </div>
            <button @click="beginQuiz()">Start Quiz</button>
        </div>
        <div class="col-sm-12" v-else-if="end">
            <button @click="beginQuiz()">Restart Quiz</button>
        </div>
    </div>
</template>

<script>
     import { eventBus } from '../main';

    export default {
        props: {
            start: Boolean,
            end: {
                type: Boolean,
                default: false
            }
        },
        created(){
            eventBus.$on('quizEnd',(end)=>{
                this.end = end;
            })
        },
        methods: {
            beginQuiz(){
                this.start = !this.start;
                this.$emit('quizStarted', this.start);
            }
        }
    }
</script>

<style>
</style>
