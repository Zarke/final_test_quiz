<template>
    <div class="container">
        <template v-if="quizStart">
            <template v-if="quizEnd" >
                <span >Congratulations {{result['name']}}, you finshed the quiz in {{result['time']}} seconds with {{result['userPoints']}} points</span>
                <app-restart @quizFinished="quizEnd = false; quizStart=false;" ></app-restart>
            </template>
            <template v-else>
                <app-timer :quizFinished="quizEnd "
                            @totalTime="updateResult($event)"
                            @date="updateResult($event)">
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
                            @startDate="updateResult($event)"
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
                result: {'name':'', 'userPoints':'','date':'', 'time':''},//results of the current quiz run  
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
                    },
                    filterable: false
                },
                resource: {},
                nodes: ['results','questions']
            }
        },
        methods:{
            updateResult(resultParams){
                if( resultParams[1] === '' && resultParams[0] == 'name' ){
                    this.result[resultParams[0]] = 'anonymous';
                } else {
                    this.result[resultParams[0]] = resultParams[1];
                }
                
            }
            
        },
        created(){
            eventBus.$on('quizEnd', ()=>{
                this.quizEnd = true;
            })
            eventBus.$on('uploadResult', () => {
                this.resource.saveRes({node: this.nodes[0]}, this.result);
            })

            //custom actions for vue resource
            const customActions = {
                getData: {method: 'GET'},
                saveRes: {method: 'POST'}
            }

            //definition of the resource
            this.resource = this.$resource('{node}.json', {}, customActions);
            
            //loading results
            this.resource.getData({node: this.nodes[0]})
                .then(responce => {
                    return responce.json();
                })
                .then(data => {
                    for (let key in data) {
                        this.tableData.push(data[key])
                    }
                })

            //loading questions
            this.resource.getData({node: this.nodes[1]})
                .then(responce => {
                    return responce.json();
                })
                .then(data => {
                    this.questionsArr = data;
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
