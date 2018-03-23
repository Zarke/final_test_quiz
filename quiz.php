<?php include("init.php");
    ?>
<html>
    <head>
    <script src="javascript/jquery-3.3.1.min.js"></script>
    <script src="javascript/main.js"></script>
    <link rel="stylesheet" type="text/css" href="includes/zoki.css">
    </head>
   
    <body>
        <div id="quiz">
            <form id="target" method="post">
                <?php
                    if(isset($_POST['next'])){
                    $question->get_question();
                    } else{
                        $question->get_question();
                        }        
                ?>
            <input type="submit" class="two" name="submit" value="submit"/>
            <input type="submit" class="two" name="next" value="next question"/>
            </form>
        </div>
        <div  id="result">
          
                <?php  
                    if(isset($_POST['submit'])){
                        $question->check();
                    }
                ?>
         
        </div>
    </body>
</html>