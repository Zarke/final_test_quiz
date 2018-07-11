<template>
    <div class="col-md-8 offset-md-2">
        <h2 class="text-center">{{questions[currQuestion].question}}</h2>
        <app-possible-ans v-for="answer in questions[currQuestion].possibleAnswers"
                            :answer="answer">
        </app-possible-ans>
        <slot></slot>
    </div>
</template>

<script>
    import { eventBus } from '../main';
    import PossibleAns from './QuestionPossibleAnswer.vue';

    export default {
        data: function(){
            return{
                questions: Array,
                currQuestion: 0
            }
        },
        computed: {
            correctIndex(){
                //index of the correct answer from the possibleAnswers array
                return this.questions[this.currQuestion].correctAnswer
            }
        },
        created(){
            fetch('./src/assets/questions.json').then(
                res => res.json()
            ).then( res => {
                this.questions = res
            }
            )
            eventBus.$on('answerSelected', (answer)=>{
                if (this.questions[this.currQuestion].possibleAnswers[this.correctIndex] == answer){
                    eventBus.$emit('points', 2);
                } else {
                    eventBus.$emit('points', -1);
                }
                if(this.currQuestion != this.questions.length-1){
                    this.currQuestion++;
                }else {
                    eventBus.$emit('quizEnd',true);
                    this.$emit('endingMessage', 'congratulations');
                }
            })
        },
          // emmit added/supstracted points to app.vue
        components: {
            appPossibleAns: PossibleAns
        }
    }
</script>

<style>
</style>
