<template>
    <div id="answer" @click="answerSelected">
        {{answer}}
    </div>
</template>

<script>
    import { eventBus } from '../main';

    export default {
        props:{
            answer: String
        },
        methods: {
            answerSelected(){
                eventBus.$emit('answerSelected',this.answer);
            }
        }
    }
</script>

<style>
#answer{
    text-align: center;
}
</style>
