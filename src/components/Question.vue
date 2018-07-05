<template>
    <div class="col-md-6 offset-md-3">
        <app-possible-ans v-for="answer in possibleAnswers"
                          :answer="answer">

        </app-possible-ans>
    </div>
</template>

<script>
    import PossibleAns from './QuestionPossibleAnswer.vue'

    export default {
        data: function(){
            return{
                possibleAnswers: [
                    'prva mogucnost',
                    'druga mogucnost',
                    'treca mogucnost',
                    'cetvrta mogucnost'
                ]
            }
        },
        components: {
            appPossibleAns: PossibleAns
        }
    }
</script>

<style>
</style>
