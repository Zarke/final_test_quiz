<?php include("includes/choices.php"); ?>
<html>
    <head>
    <script src="javascript/jquery-3.3.1.min.js"></script>
    <script src="javascript/jquery.cookie.js"></script>
    <script src="javascript/main.js"></script>
    <link rel="stylesheet" type="text/css" href="css/choice.css">
    <script>
        $(document).ready(function(){
            $(".img_check__form-possible_answer").on('click',function(){
                $(".img_check__form-possible_answer").removeClass("active");
                $(this).addClass("active");
            });
        });
    </script>
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
        <section class="row img_check">
            <div class="col m12 img_check__answers">
                <?php  
                    if(isset($_POST['check'])){
                        $choice->checkbox_guess();
                    }
                ?>
            </div>
            <form method="post" class="img_check__form">
                <h3 class="img_check__form-heading col m8 offset-m2 center-align">Čestitamo, odgovorili ste tačno na sva pitanja! Sada proverite svoje znanje tako što ćete pokušati da pogodite o kojoj tvrđavi je reč.</h3>
                <?php $choice->checkbox_listing(); $choice->choose_action();?>
                <input type="submit" class="img_check__form-btn btn-rerun" name="rerun" value="Ponoviti selekciju"/>
                <input type="submit" class="img_check__form-btn btn-check" name="check" value="Potvrdi odabir"/>
                <input type="submit" class="img_check__form-btn btn-new_selection" name="new_selection" value="Nova selekcija"/>
            </form>
        </section>
    </body>
</html>