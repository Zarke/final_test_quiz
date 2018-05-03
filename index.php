<?php include("includes/selection.php");
    ?>
<html>
    <head>
    <script src="javascript/jquery-3.3.1.min.js"></script>
    <script>
        $(document).ready(function(){
            $(".section__choose-form-option").on('click',function(){
                $(".section__choose-form-option").removeClass("active");
                $(this).addClass("active");
            });
        });
    </script>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    </head>
    <body class="container">
        <section class="section__choose">
            <div class="row">
                <form class="section__choose-form col m12 " method="post">
                    <?php
                        $selection->show_selections();
                        $selection->set_selection_and_redirect();
                    ?>
                    <input type="submit" class="section__choose-form-submit " name="submit" value="Potvrda odabira"/>
                </form>
            </div>
        </section>
    </body>
</html>