<?php include("init.php");?>
<html>
    <body>
        <form method="post">
            <?php $question->get_question()?>
            <input type="submit" name="submit" value="submit"/>
        </form>
    </body>
</html>