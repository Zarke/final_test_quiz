<?php include("question.php");?>
<html>
    <body>
        <form action="action.php">
            <?php $question->get_question()?>
            <input type="submit" value="Submit">
        </form>
    </body>
</html>