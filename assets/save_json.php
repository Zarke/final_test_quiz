<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // read the file if present
    $myFile = '../results.json';
    $handle = @fopen($myFile, 'r+');
    $stringData = $_POST["data"];
    
    // create the file if needed
    if ($handle === null) {
        $handle = fopen($myFile, 'w+');
    }

    if ($handle){
        // seek to the end
        fseek($handle, 0, SEEK_END);

        // are we at the end of is the file empty
        if (ftell($handle) > 0) {
            // move back a byte
            fseek($handle, -1, SEEK_END);
            // add the trailing comma
            fwrite($handle, ',', 1);
            // add the new json string
            fwrite($handle, $stringData . ']');
        }
        else{
            // write the first event inside an array
            fwrite($handle, json_encode(array($stringData)));
        }
        // close the handle on the file
        fclose($handle);
    }
}

?>