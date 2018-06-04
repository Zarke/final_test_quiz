//function that ends the quiz and displays users results
function quizStop(){
    if(current == questions.length){
        
        $("#quiz").hide();
        clearInterval(timer);
        time = $("span.timer").text().replace(" Seconds","");
        console.log(time);
        $("div.elapsed_time").html("Congratulations!! You finished the quiz in "+ time).show();
        $("div.gained_poins").html("In this session you got  "+points+" points").show();
        $("#restart").show();
        $("span.timer").hide();
        $("div#end").show();
        $("b#points").hide();
    } else{
        $("#quiz").view(questions[current]);
    }
}

//function for properly displaying point count
function displayPoints(){
    if (points == -1 || points == 1){
        $("b#points").html(points + ' point');
    } else {
        $("b#points").html(points + ' points');
    }
}


//function that updates the results.json file by adding current users stats
function addResult(){
    result["userPoints"] = points;
    result["date"] = startDate;
    result["time"] = time;
    results.push(result);
    
    $.ajax
    ({
        type: "POST",
        dataType : 'json',
        async: false,
        url: 'http://localhost/SPA%20-%20quiz/assets/save_json.php',
        data: { data: JSON.stringify(result) },
        success: function () {alert("Thanks!"); },
        failure: function() {alert("Error!");}
    });
}


