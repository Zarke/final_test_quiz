<?php include("includes/choices.php"); ?>
<html>
    <head>
    <script src="javascript/jquery-3.3.1.min.js"></script>
    <script src="javascript/jquery.cookie.js"></script>
    <script src="javascript/main.js"></script>
    <link rel="stylesheet" type="text/css" href="css/choice.css">
    <script>
        //table backgroud image is dinamicaly set base on the selected question set
        $(document).ready(function(){
            
        });
    </script>
    </head>
    
    <body>
        <table class="img__cover">
            <tr>
                <td class="img__section 0"></td>
                <td class="img__section 1"></td>
                <td class="img__section 2"></td>
            </tr>
            <tr>
                <td class="img__section 3"></td>
                <td class="img__section 4"></td>
                <td class="img__section 5"></td>
            </tr>
            <tr>
                <td class="img__section 6"></td>
                <td class="img__section 7"></td>
                <td class="img__section 8"></td>
            </tr>
        </table>
        <div id="mainlast">
            <form method="post" class="formlast">
                <h1 class="captionlast">Čestitamo, odgovorili ste tačno na sva pitanja! Sada proverite svoje znanje tako što ćete pokušati da pogodite o kojoj tvrđavi je reč.</h1>
                <?php $choice->checkbox_listing(); $choice->choose_action();?>
                <input type="submit" class="buttonlast" name="rerun" value="Ponoviti prolaz kroz trenutnu selekciju"/>
                <input type="submit" class="buttonlast3" name="check" value="Potvrdi odabir"/>
                <input type="submit" class="buttonlast2" name="new_selection" value="Odabir nove selekcije"/>
            </form>
        </div>
    </body>
</html>