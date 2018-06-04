$.getScript('assets/functions.js', function(){
    console.log('script successfully imported');
});


var results;
var result = {
    name: '',
    userPoints: 0,
    date: '',
    time: ''
}
var questions;
//retrieving questions and results of previous test runs
$.getJSON('questions.json', function(json) {
    questions = json;
  });
  $.getJSON('results.json', function(json) {
    results = json;
  });

var current;//position of the current question in the results array
var points;//points the user has acumulated during the duration of the test
var timer; //variable that defines the timer
//function that ends the quiz
var startDate = new Date;
startDate.toUTCString();


 $(function(){
    $(".results").view(results);
    $("div#quiz").hide();
    $(".elapsed_time").hide();
    $(".gained_poins").hide();
    $("#restart").hide();
    $("table").DataTable({
        "order":[[1, "desc"], [3, "asc"]]
    });
    $("#quiz").on("click", "li.bind-possibleAnswers", 
    
    function(e){

        var current_question = questions[current];
        var correct_answer = current_question.correctAnswer;
        var correct_text = current_question.possibleAnswers[correct_answer];
        

        //point counting function
        if( e.target.innerText == correct_text){
            points +=2;
            displayPoints()
            current++;
            quizStop();
        } else {
            points -=1;
            displayPoints()
            current++;
            quizStop();
        }

        

    });

    
    $("#start_quiz").click(function(){
        current = 0;
        points = 0;
        timer = 0;
        var start = new Date;//the time when the user has started the quiz 
        var startTime = start.getTime();
        start.toUTCString();
        $("div#quiz").show();
        $("div.resultList").hide();        
        $("#quiz").view(questions[current]);
        $("#username").hide();
        $("#start_quiz").hide();
        $("label").hide();
        $("b#points").html(points + ' points').show();
        if ( !$("#username").val()){
            result["name"] = "anonymous";
        }else {
            result["name"] = $("#username").val();
        }
        
    
        //timer that is displayed during the duration of the quiz
        timer = setInterval(function() {
            var currDate = new Date;
            var currTime = currDate.getTime();
            var minutes = Math.floor((currTime - startTime) / 60000);
            var seconds = (((currTime - startTime) % 60000) / 1000).toFixed(0);
            timeFormatting(minutes,seconds);
        }, 1000);
       
    }) ; 
 
    $("#restart").click(function(){
        $(".elapsed_time").hide();
        $(".gained_poins").hide();
        $("#restart").hide();
        current = 0;
        location.reload(true);
        $("table").DataTable();
        $("div.resultList").show();
        $("#start_quiz").show();
        $("#username").show();
        $("label").show();
        addResult();
        
    });
 
 });
 