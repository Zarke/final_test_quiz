<?php include("init.php");
    ?>
<html>
    <script src="javascript/jquery-3.3.1.min.js"></script>
    <script src="javascript/main.js"></script>
    <body>
        <form id="target" method="post">
        <?php
            if(isset($_POST['next'])){
            $question->get_question();
       }   ?>
            <input type="submit" class="kec" name="submit" value="submit"/>
            <input type="submit" class="kec" name="next" value="next question"/>
        </form>
        <div>
            <ul>
                <?php  
                    if(isset($_POST['submit'])){
                        $question->check();
                    }
                ?>
            </ul>
        </div>
    </body>
</html>