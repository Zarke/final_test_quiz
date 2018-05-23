<?php include("includes/choices.php");
    ?>
<html>
    <head>
    <link rel="stylesheet" type="text/css" href="css/style.min.css">
    </head>
    <body class="container">
        <section class="row section_choose_action">
        <div class="spacer"></div>
            <form method="post" class="section_choose_action__form">
                <h1 class="section_choose_action__form-heading center-align ">Prošli ste ovaj deo kviza. Molimo vas da izaberete kako želite da nastavite</h1>
                <input type="submit" class="section_choose_action__form-btn btn-rerun" name="rerun" value="Ponoviti trenutnu selekciju"/>
                <input type="submit" class="section_choose_action__form-btn btn-new_selection" name="new_selection" value="Nova selekcija"/>
            </form>
        </section>
    </body>
</html>