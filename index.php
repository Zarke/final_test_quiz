<?php include("includes/selection.php");
    ?>
<html>
    <head>
        <script src="javascript/jquery-3.3.1.min.js"></script>
        <script>
            $(document).ready(function(){
                $(".section_choice__form-option").on('click',function(){
                    $(this).toggleClass("active");
                });
            });
    </script>
    <link rel="stylesheet" type="text/css" href="css/style.min.css">
    </head>
    <body class="container">
        <section class="section_choice">
            <div class="row">
                <form class="section_choice__form" method="post">
                    <?php
                        $selection->show_selections();
                        $selection->set_selection_and_redirect();
                    ?>
                    <input type="submit" class="section_choice__form-submit" name="submit" value="submit"/>
                </form>
            </div>
        </section>
    </body>
</html>