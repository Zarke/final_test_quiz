<?php include("includes/selection.php");
    ?>
<html>
    <head>
    <link rel="stylesheet" type="text/css" href="includes/zoki.css">
    </head>
    <body>
        <div id="quiz">
            <form method="post">
                <?php
                    $selection->show_selections();
                    $selection->set_selection_and_redirect();
                ?>
                <input type="submit" class="two" name="submit" value="submit"/>
            </form>
        </div>
    </body>
</html>