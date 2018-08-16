<template>
    <div class="row justify-content-center mt-3">
        <b>Points: {{returnPoints}}</b>
        <slot name="points"></slot>
    </div>
</template>

<script>
    import { eventBus } from '../../main';
    import { mapGetters } from 'vuex';

    export default {
        data: function(){
            return{
                dataPoints: 0
            }
        },
        computed: {
            ...mapGetters([
                'returnPoints'
            ])
        },
        created(){
            eventBus.$on('points', (points)=>{
                this.dataPoints = this.dataPoints + points;
            })
        }
        
    }
</script>

<style>
</style>
