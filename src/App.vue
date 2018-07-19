<template>
    <div class="container">
        <template v-if="quizStart">
            <template v-if="quizEnd" >
                <span >Congratulations {{results['username']}}, you finshed the quiz in {{results['totalTime']}} seconds with {{results['totalPoints']}} points</span>
                <app-restart @quizFinished="quizEnd = false; quizStart=false"></app-restart>
            </template>
            <template v-else>
                <app-timer :quizFinished="quizEnd"
                            @totalTime="updateResults($event)">
                </app-timer>
                <app-questions :questions="questionsArr">
                </app-questions>
                <app-points  @totalPoints="updateResults($event)"></app-points>
            </template>
        </template>
        <template v-else>
            <app-start-form @quizStarted="quizStart = true"
                            @username="updateResults($event)"
            >
            </app-start-form>
            <div id="table" class="col-xs-12 table-responsive">
                <v-client-table :data="tableData" :columns="columns" :options="options"></v-client-table>
            </div>
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
                results: {'username':'', 'totalTime':'', 'totalPoints':''},//results of the current quiz run  
                columns: ['name', 'userPoints', 'date', 'time'],
                tableData: [],
                options: {
                    filterByColumn: true,
                    headings: {
                        name: 'Name',
                        userPoints: 'Points',
                        date: 'Date',
                        time: 'Time',
                      },
                },
                sortOrder: [
                {
                  field: 'userPoints',
                  direction: 'asc'
                }
    ]
            }
        },
        methods:{
            updateResults(resultsParams){
                if( resultsParams[1] === '' && resultsParams[0] == 'username' ){
                    this.result[resultsParams[0]] = 'anonymous';
                }
                this.results[resultsParams[0]] = resultsParams[1];
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
