<html>
    <?php require_once('assets/save_json.php')?>
    <head>
        <title>quiz</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css
        ">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
        <script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
          integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
            crossorigin="anonymous"></script>
        <script src="assets/jquery.view-engine.js"></script>
        <script src="assets/quiz.js"></script>
    </head>
<body>
<div class="jumbotron jumbotron-fluid">
    <span class="timer"></span>
  <div id="quiz" class="container">
    <h1 id="question"></h1>
    <ul class="list-group">
        <li class="bind-possibleAnswers list-group-item"></li>    
    </ul>
  </div>
  <div class="container resultList">
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Points</th>
                <th>Date</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
            <tr class="results">
                <td class="bind-name"></td>
                <td class="bind-userPoints"></td>
                <td class="bind-date"></td>
                <td class="bind-time"></td>
            </tr>
        </tbody>   
    </table>
</div>
<div class="row justify-content-md-center">
    <div class=" col-md-2 offset-md-2 elapsed_time text-center"></div>
    <div class="col-md-2 offset-md-3 gained_poins text-center "></div>
</div>
</div>
<div class="d-flex justify-content-center end">
    
    <button id="restart" type="button" class="btn btn-dark ">Restart quiz</button>
</div> 
<div class="d-flex justify-content-center control_group">
    <label for="username">Name:</label>
    <input id="username" type="text" >
    <button id="start_quiz" type="button" class="btn btn-dark ">Start Quiz</button>
    <b id="points"></b>
</div>

</body>
</html>