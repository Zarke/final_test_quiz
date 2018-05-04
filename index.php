<?php include("includes/selection.php");
    ?>
<html>
    <head>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    </head>
    <body>
        <div id="begin">
            <form class="beginform" method="post">
                <?php
                    $selection->show_selections();
                    $selection->set_selection_and_redirect();
                ?>
                <input type="submit" class="beginsubmit" name="submit" value="submit"/>
            </form>
        </div>
    </body>
</html>