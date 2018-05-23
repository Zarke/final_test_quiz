<?php include("init.php");
    ?>
<html>
    <head>
    <script src="javascript/jquery-3.3.1.min.js"></script>
    <script>
        $(document).ready(function(){
            $(".question__form-possible_answer").on('click',function(){
                $(this).toggleClass("active");
            });
        });
    </script>
    <link rel="stylesheet" type="text/css" href="css/style.min.css">
    </head>
   
    <body class="container">
        <section class=" row question">
        <div class="question__answers col m12">
          <?php  
              if(isset($_POST['submit'])){
                  $question->check();
              }
          ?>
        </div>
        <div class="row">
            <form class="question_form col m12" method="post">
                <?php
                    if(isset($_POST['next'])){
                    $question->get_question();
                     }
                    else if(isset($_POST['submit'])){
                        $question->get_current_question();
                    } else {
                        $question->get_question();
                    }        
                ?>
            <div class="spacer"></div>    
            <input type="submit" class="question__form-btn btn-submit" name="submit" value="submit"/>
            <input type="submit" class="question__form-btn btn-next" name="next" value="next question"/>
            </form>
        </div>
        
        </section>
    </body>
</html>