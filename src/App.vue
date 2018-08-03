<template>
    <div class="container">
        <template v-if="quizStart">
            <template v-if="quizEnd" >
                <span >Congratulations {{result['username']}}, you finshed the quiz in {{result['totalTime']}} seconds with {{result['totalPoints']}} points</span>
                <app-restart @quizFinished="quizEnd = false; quizStart=false;" :result="result"></app-restart>
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
                    orderBy:{ascending:false, 'column':'userPoints'},
                    multiSorting: {
                        userPoints: [
                            {   column: 'time', matchDir: false}
                           
                        ]
                    }
                },
                resource: {},
                nodes: ['results','questions']
            }
        },
        methods:{
            updateResult(resultParams){
                if( resultParams[1] === '' && resultParams[0] == 'username' ){
                    this.result[resultParams[0]] = 'anonymous';
                }
                this.result[resultParams[0]] = resultParams[1];
            }
            
        },
        created(){
            const customActions = {
                getData: {method: 'GET'},
                saveAlt: {method: 'POST'}
            }

            this.resource = this.$resource('{node}.json', {}, customActions);
            
            //loading results
            this.resource.getData({node: this.nodes[0]})
                .then(responce => {
                    return responce.json();
                })
                .then(data => {
                    this.tableData = data;
                })

            //loading questions
            this.resource.getData({node: this.nodes[1]})
                .then(responce => {
                    return responce.json();
                })
                .then(data => {
                    this.questionsArr = data;
                })


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
