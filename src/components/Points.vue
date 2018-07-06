<template>
    <div class="row">
        Points: {{points}}
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
