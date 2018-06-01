
var results = [
    {
        date: '31.05.2015',
        points: 30,
        time: '23 minutes and 54 seconds'
    }
];
var result = {
    date: '',
    points: 0,
    time: ''
}
var questions;
$.getJSON('questions.json', function(json) {
    questions = json;
  });
 
var current = 0;
var points = 0;
 $(function(){
    $("#resultTable").view(results[0]);
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
    $("div#quiz").show();
    $("div#resultTable").hide();        
    $("#quiz").view(questions[current]);
    $("#show_results").hide();
        
 })    
 });
 