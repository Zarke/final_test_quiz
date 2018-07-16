<template>
    <div class="container">
        <template v-if="quizStart">
            <template v-if="quizEnd" >
                <span >Congratulations, you finshed the quiz!!! </span>
                <app-restart @quizFinished="quizEnd = false; quizStart=false"></app-restart>
            </template>
            <template v-else>
                <app-timer :quizFinished="quizEnd"></app-timer>
                <app-questions :questions="questionsArr">
                </app-questions>
                <app-points></app-points>
            </template>
        </template>
        <template v-else>
            <app-start-form @quizStarted="quizStart = true;"
            >
            </app-start-form>
        </template>      
    </div>
</template>

<script>
    import { eventBus } from './main';
    import StartForm from './components/quizInitialization/StartForm.vue';
    import Restart from './components/quizInitialization/Restart.vue';
    import Timer from './components/Timer.vue';
    import Points from './components/Points.vue';
    import Questions from './components/Question.vue';
    

    export default {
        data: function(){
            return {
                quizStart: false,
                quizEnd: false,
                questionsArr: Array,
                total: 0    
            }
        },
        created(){
            fetch('./src/assets/questions.json').then(
                res => res.json()
            ).then( res => {
                this.questionsArr = res
                }
            )
            fetch('./src/assets/results.json').then(
                res => res.json()
            ).then( res => {
                this.resultsArr = res
                }
            )
            eventBus.$on('quizEnd', (responce)=>{
                // appQuestions.$destroy();
                this.quizEnd = true;
            })
        },
       components: {
           appStartForm: StartForm,
           appTimer: Timer,
           appPoints: Points,
           appQuestions: Questions,
           appRestart: Restart
       }
    }
</script>

<style>
</style>
