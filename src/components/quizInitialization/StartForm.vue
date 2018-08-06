<template>
    <div class="row">
        <div class="form-group">
            <label for="name" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-10">
                <input type="text" v-model="username" placeholder="username">
            </div>
            <button @click="beginQuiz()">Start Quiz</button>
        </div>
        
    </div>
</template>

<script>
     import { eventBus } from '../../main';

    export default {
        data: function(){
            return{
                username: ''
            }
        },
        methods: {
            beginQuiz(){
                this.start = !this.start;
                this.end = false;
                this.$emit('quizStarted', this.start);
                this.$emit('quizEndChange', false)
            }

        },
        beforeDestroy(){
            this.$emit('username', ['name', this.username]);
            
        }
    }
</script>

<style>
</style>
