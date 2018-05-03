<?php include("init.php");
    ?>
<html>
    <head>
    <script src="javascript/jquery-3.3.1.min.js"></script>
    <script src="javascript/jquery.cookie.js"></script>
    <script src="javascript/main.js"></script>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    </head>
   
    <body class="container">
    <table class="responsive-table table__img">
        <tr>
            <td class="img__section table__img--section id-0"></td>
            <td class="img__section table__img--section id-1"></td>
            <td class="img__section table__img--section id-2"></td>
        </tr>
        <tr>
            <td class="img__section table__img--section id-3"></td>
            <td class="img__section table__img--section id-4"></td>
            <td class="img__section table__img--section id-5"></td>
        </tr>
        <tr>
            <td class="img__section table__img--section id-6"></td>
            <td class="img__section table__img--section id-7"></td>
            <td class="img__section table__img--section id-8"></td>
        </tr>
    </table>
        <section class="row question">
            <div class="col m12 question__answers ">
                <?php  
                    if(isset($_POST['submit'])){
                        $question->check();
                    }
                ?>
            </div>

            <form class="question__form" method="post">
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
                <input type="hidden" id="selected_answers" name="selected_answers" />
                <input type="submit" class=" waves-effect waves-light question__form-btn btn-submit" name="submit" value="provera"/>
                <input type="submit" class=" waves-effect waves-light question__form-btn btn-next" name="next" value="Sledeće pitanje"/>
            </form>
        </section>    
    </body>
</html>