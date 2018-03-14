<?php
    $answers = array();//all correct answers
    $unckecked_correct = array();//all checked correct answers
    $id_answer = 0;
    //deletes an item from the dopy of the correct answer array
    function deleteElement($element, &$array){
        $index = array_search($element, $array);
        if($index !== false){
            unset($array[$index]);
        }
    }
        //Checks what answers are correct and tells the user what the mistake was and what is the correct answer
        if(isset($_POST['submit'])){
           foreach ($question->documents->{0}->tacni_odgovori as $answer) {
               $answers[$id_answer] = $answer;
               $id_answer = $id_answer+1; 
           }
           $id_answer = 0;
           $unchecked_correct = $answers;
           foreach ($_POST['correct'] as $answer) {
                if(in_array($answer ,$answers)){
                    echo "The answer ". $question->documents->{0}->moguci_odgovori->{$answer} ." is correct <br>";
                    deleteElement($answer, $unchecked_correct);
                } else {
                    echo "The answer ".$question->documents->{0}->moguci_odgovori->{$answer} ." is not correct <br>";
                }
            }//end of foreach lop
            
            //loops all the unchecked correct answers
           foreach ($unchecked_correct as $correct) {
               echo "You shoud have also checked ".$question->documents->{0}->moguci_odgovori->{$correct}."<br>" ;
           } 
        }
           
      
?>