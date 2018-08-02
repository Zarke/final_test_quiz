<template>
    <div class="container">
        <template v-if="quizStart">
            <template v-if="quizEnd" >
                <span >Congratulations {{result['username']}}, you finshed the quiz in {{result['totalTime']}} seconds with {{result['totalPoints']}} points</span>
                <app-restart @quizFinished="quizEnd = false; quizStart=false; "></app-restart>
            </template>
            <template v-else>
                <app-timer :quizFinished="quizEnd"
                            @totalTime="updateResult($event)">
                </app-timer>
                <app-questions :questions="questionsArr">
                </app-questions>
                <app-points  @totalPoints="updateResult($event)"></app-points>
            </template>
        </template>
        <template v-else>
            <div id="table" class="col-xs-12 table-responsive">
                <v-client-table :data="tableData" :columns="columns" :options="options"></v-client-table>
            </div>
            <app-start-form @quizStarted="quizStart = true"
                            @username="updateResult($event)"
            >
            </app-start-form>
            
        </template>      
    </div>
</template>

<script>
    import { eventBus } from './main';
    import StartForm from './components/quizInitialization/StartForm.vue';
    import Restart from './components/quizInitialization/Restart.vue';
    import Timer from './components/quizFunctionality/Timer.vue';
    import Points from './components/quizFunctionality/Points.vue';
    import Questions from './components/quizFunctionality/Question.vue';
    

    export default {
        data: function(){
            return {
                quizStart: false,
                quizEnd: false,
                questionsArr: Array,
                result: {'username':'', 'totalTime':'', 'totalPoints':''},//results of the current quiz run  
                columns: ['name', 'userPoints', 'date', 'time'],
                tableData: [],
                options: {
                    headings: {
                        name: 'Name',
                        userPoints: 'Points',
                        date: 'Date',
                        time: 'Time',
                    },
                    orderBy:{ascending:false,'column': 'userPoints'},
                    clientMultiSorting:true 
                }
            }
        },
        methods:{
            updateResult(resultParams){
                if( resultParams[1] === '' && resultParams[0] == 'username' ){
                    this.result[resultParams[0]] = 'anonymous';
                }
                this.result[resultParams[0]] = resultParams[1];
            },
            updateResultsJSON(entry){
                
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
                this.tableData = res
                }
            )
            eventBus.$on('quizEnd', (responce)=>{
                this.quizEnd = true;
            })
            
        },
       components: {
           appStartForm: StartForm,
           appTimer: Timer,
           appPoints: Points,
           appQuestions: Questions,
           appRestart: Restart,
           Event
        }
    }
</script>

<style>
</style>
