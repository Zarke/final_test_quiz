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
    import { mapMutations } from 'vuex';

    export default {
        data: function(){
            return{
                username: ''
            }
        },
        methods: {
            ...mapMutations([
                'quizStateChange',
                'updateUser'
            ]),
            beginQuiz(){
                this.quizStateChange({
                    key: 'start/end',
                    start: true,
                    end: false
                })
            }
        },
        beforeDestroy(){
            if (this.username == '') {
                this.updateUser({
                    key: 'name',
                    value: 'anonymous'
                })
            } else {
                this.updateUser({
                    key: 'name',
                    value: this.username
                })
            }
            
        }
    }
</script>

<style>
</style>
