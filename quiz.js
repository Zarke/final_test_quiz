
var results;
var result = {
    name: '',
    points: 0,
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
function quiz_stop(){
    if(current == questions.length){
        $("#quiz").hide();
        clearInterval(timer);
        $("div.elapsed_time").html("Congratulations!! You finished the quiz in "+timer+" seconds").show();
        $("div.gained_poins").html("In this session you got  "+points+" points").show();
        $("#restart").show();
        $("span.timer").hide();
        $("div#end").show();
        $("b#points").hide();
        
    } else{
        $("#quiz").view(questions[current]);
    }
}
 $(function(){
    $(".results").view(results);
    $("div#quiz").hide();
    $(".elapsed_time").hide();
    $(".gained_poins").hide();
    $("#restart").hide();
    $("table").DataTable();
    $("#quiz").on("click", "li.bind-possibleAnswers", 
    
    function(e){

        var current_question = questions[current];
        var correct_answer = current_question.correctAnswer;
        var correct_text = current_question.possibleAnswers[correct_answer];
        

        //point counting function
        if( e.target.innerText == correct_text){
            points +=2;
            if (points == -1 || points == 1){
                $("b#points").html(points + ' point');
            } else {
                $("b#points").html(points + ' points');
            }
            current++;
            quiz_stop();
        } else {
            points -=1;
            if (points == -1 || points == 1){
                $("b#points").html(points + ' point');
            } else {
                $("b#points").html(points + ' points');
            }
            current++;
            quiz_stop();
        }

        

    });

    
    $("#start_quiz").click(function(){
        current = 0;
        points = 0;
        timer = 0;
        var start = new Date;//the time when the user has started the quiz 
        $("div#quiz").show();
        $("div.resultList").hide();        
        $("#quiz").view(questions[current]);
        $("#username").hide();
        $("#start_quiz").hide();
        $("label").hide();
        $("#points").show();
        result[name]=$("#username").val();
    
        //timer that is displayed during the duration of the quiz
        timer = setInterval(function() {
            $('.timer').text(Math.round((new Date - start) / 1000, 0) + " Seconds");
        }, 1000);
        
    }) ; 
 
    $("#restart").click(function(){
        $(".elapsed_time").hide();
        $(".gained_poins").hide();
        $("#restart").hide();
        current = 0;
        $("table").DataTable();
        $("div.resultList").show();
        $("#start_quiz").show();
        $("#username").show();
        $("label").show();
    });
 
 });
 