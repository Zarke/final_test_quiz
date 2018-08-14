<template>
    <div class="row justify-content-center mt-3">
        <b>{{dataCaption}}  {{dataPoints}}</b>
        <slot name="points"></slot>
    </div>
</template>

<script>
    import { eventBus } from '../../main';

    export default {
        data: function(){
            return{
                dataPoints: 0,
                dataCaption: 'Points'
            }
        },
        created(){
            eventBus.$on('points', (points)=>{
                this.dataPoints = this.dataPoints + points;
            })
        },
        beforeDestroy(){
            this.$store.commit('updateUser', {
                    key: 'userPoints',
                    value: this.dataPoints
                })
                console.log(this.dataPoints);
        }
    }
</script>

<style>
</style>
