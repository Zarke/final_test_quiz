<?php include("init.php");
    ?>
<html>
    <head>
    <script src="javascript/jquery-3.3.1.min.js"></script>
    <script src="javascript/jquery.cookie.js"></script>
    <script src="javascript/main.js"></script>
    <link rel="stylesheet" type="text/css" href="includes/zoki.css">
    <script>
        //table backgroud image is dinamicaly set base on the selected question set
        $(document).ready(function(){
            var img_id_cookie = $.cookie("img_id");
            var img_id = $.parseJSON(img_id_cookie);
            var img_url = "url(images/fortress-"+ img_id + ".jpg)";
            $("table").css("background-image",img_url);
            var correct_sections = $.cookie("correct_sections");
            var data = $.parseJSON(correct_sections);
            $.each(data, function(i,item){
                $("td").each(function(){
                    if($(this).hasClass(item)){
                        $(this).removeClass("img__section");
                    };
                });
            });
        });
    </script>
    </head>
   
    <body>
    <?php
        
    ?>
    <table class="img__cover">
        <tr>
            <td class="img__section 0"></td>
            <td class="img__section 1"></td>
            <td class="img__section 2"></td>
        </tr>
        <tr>
            <td class="img__section 3"></td>
            <td class="img__section 4"></td>
            <td class="img__section 5"></td>
        </tr>
        <tr>
            <td class="img__section 6"></td>
            <td class="img__section 7"></td>
            <td class="img__section 8"></td>
        </tr>
    </table>
        <div id="quiz">
            <form id="target" method="post">
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
            <input type="submit" class="two" name="submit" value="submit"/>
            <input type="submit" class="two" name="next" value="next question"/>
            </form>
        </div>
        <div id="result">
          
                <?php  
                    if(isset($_POST['submit'])){
                        $question->check();
                    }
                ?>
         
        </div>
    </body>
</html>