<template>
    <div class="row justify-content-center mt-3">
        <b>Points: {{points}}</b>
    </div>
</template>

<script>
    import { eventBus } from '../main';

    export default {
        props:{
            points: {
                type: Number,
                default: 0
            }
        },
        created(){
            eventBus.$on('points', (points)=>{
                this.points = this.points + points;
            })
        }
    }
</script>

<style>
</style>
