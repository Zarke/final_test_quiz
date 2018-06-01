
var results;
var result = {
    name: '',
    points: 0,
    date: '',
    time: ''
}
var questions;
$.getJSON('questions.json', function(json) {
    questions = json;
  });
  $.getJSON('results.json', function(json) {
    results = json;
  });
var resultCount = 0;
var current = 0;
var points = 0;
 $(function(){
     $("#results").view(results);
    $("div#quiz").hide();
    $("#quiz").on("click", "li.bind-possible_answers", function(e){

        var current_question = questions[current];
        var correct_answer = current_question.correct_answer;
        var correct_text = current_question.possible_answers[correct_answer];

        if( e.target.innerText == correct_text){
            points +=2;
            if (points == -1 || points == 1){
                $("b#points").html(points + ' point');
            } else {
                $("b#points").html(points + ' points');
            }
            current++;
            $("#quiz").view(questions[current]);
        } else {
            points -=1;
            if (points == -1 || points == 1){
                $("b#points").html(points + ' point');
            } else {
                $("b#points").html(points + ' points');
            }
            
        }

    });

    
 $("#show_results").click(function(event){
    var start = new Date;
    $("div#quiz").show();
    $("div#resultTable").hide();        
    $("#quiz").view(questions[current]);
    $("#show_results").hide();
    setInterval(function() {
        $('.timer').text(Math.round((new Date - start) / 1000, 0) + " Seconds");
    }, 1000);
        
 })    
 });
 