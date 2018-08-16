<template>
    <div class="col-md-8 offset-md-2" >
        <h2 class="text-center">{{dataQuestions[currQuestion].question}}</h2>
        <app-possible-ans v-for="answer in dataQuestions[currQuestion].possibleAnswers"
                            :answer="answer">
        </app-possible-ans>
        <slot></slot>
    </div>
</template>

<script>
    import { eventBus } from '../../main';
    import PossibleAns from './QuestionPossibleAnswer.vue';

    export default {
        props:{
            questions: Array
        },
        data: function(){
            return{
                currQuestion: 0,
                dataQuestions: this.questions
            }
        },
        computed: {
            correctIndex(){
                //index of the correct answer from the possibleAnswers array
                return this.dataQuestions[this.currQuestion].correctAnswer
            }
        },
        created(){
            eventBus.$on('answerSelected', (answer)=>{
                if (this.dataQuestions[this.currQuestion].possibleAnswers[this.correctIndex] == answer){
                    this.$store.commit('updatePoints', {
                        value: 2,
                        reset: false
                    });
                } else {
                    this.$store.commit('updatePoints', {
                        value: -1,
                        reset: false
                    });
                }
                if(this.currQuestion != this.dataQuestions.length-1){
                    this.currQuestion++;
                }else {
                    this.currQuestion = 0;
                    this.$store.commit('quizStateChange', {
                        start:true,
                        end: true
                    });
                }
            })
            
        },
        beforeDestroy(){
            //we destroy the event handler to avoid it executing multiple times
            eventBus.$off('answerSelected');
        },
        components: {
            appPossibleAns: PossibleAns
        }
    }
</script>

<style>
</style>
