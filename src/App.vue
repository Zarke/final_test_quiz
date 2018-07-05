<template>
    <div class="container">
        <template v-if="quizStart">
            <app-timer></app-timer>
            <app-questions></app-questions>
            <app-points></app-points>
        </template>
        <app-start-form :start="quizStart"
                        @quizStarted="quizStart = !quizStart">
        </app-start-form>
    </div>
</template>

<script>
    import StartForm from './components/StartForm.vue';
    import Timer from './components/Timer.vue';
    import Points from './components/Points.vue';
    import Questions from './components/Question.vue';

    export default {
        data: function(){
            return {
                quizStart: false
            }
        },
       components: {
           appStartForm: StartForm,
           appTimer: Timer,
           appPoints: Points,
           appQuestions: Questions
       }
    }
</script>

<style>
</style>
