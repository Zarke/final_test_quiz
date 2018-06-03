<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $myFile = "../results.json";
$fh = fopen($myFile, 'w') or die("can't open file");
$stringData = $_POST["data"];
json_encode($stringData, JSON_PRETTY_PRINT);
fwrite($fh, $stringData);
fclose($fh);
echo('Upisao sam ga');
}

?>