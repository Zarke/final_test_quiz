<?php    
    class question {
        public $cookie_name = "question_id";
        public $url = null;
        public $data = null;
        public $documents = null;
        public $id = 0;
        public $answers = array();//all correct answers
        public $unchecked_correct = array();//all checked correct answers
        public $id_answer = 0;
        public $value = null;
        
        //extraction and formating of the json file
        public function get_json(){
            $this->url = 'document.json';
            $this->data = file_get_contents($this->url); 
            $this->documents = json_decode($this->data);
        }

        //method for printing the question
        public function get_question(){
           $question_id = $this->get_cookie();
           echo "<h1>".$this->documents->{$question_id}->pitanje."</h1> <br>";
           foreach ($this->documents->{$question_id}->moguci_odgovori as $key => $odgovor) {
               echo "<input class=\"kec\" type='checkbox' name= 'checkbox[]' value=" .$key.">".$odgovor."<br>";
               
           }
        }

        //Checks what answers are correct and tells the user what the mistake was and what is the correct answer
        public function check(){
                $question_id_val = $this->get_cookie();
                foreach ($this->documents->{$question_id_val}->tacni_odgovori as $answer) {
                    $answers[$this->id_answer] = $answer;
                    $this->id_answer ++;
                }
               
               $id_answer = 0;
               $unchecked_correct = $answers;
               
               foreach ($_POST['checkbox'] as $answer) {
                    if(in_array($answer ,$answers)){
                        echo "<li class=\"true\">The answer ". $this->documents->{$question_id_val}->moguci_odgovori->{$answer} ." is correct </li><br>";
                        question::deleteElement($answer, $unchecked_correct);
                    } else {
                        echo "<li class=\"false\">The answer ".$this->documents->{$question_id_val}->moguci_odgovori->{$answer} ." is not correct </li><br>";
                    }
                }//end of foreach lop
                
                //loops all the unchecked correct answers
               foreach ($unchecked_correct as $correct) {
                   echo "<li class=\"should\">You shoud have also checked ".$this->documents->{$this->id}->moguci_odgovori->{$correct}."</li><br>" ;
               } 
               $this->get_question();
        }

        //deletes an item from the dopy of the correct answer array
        private function deleteElement($element, &$array){
            $index = array_search($element, $array);
            if($index !== false){
                unset($array[$index]);
            }
        }

        //method for setting and updating the cookie value
        public function get_cookie(){
            if(!isset($_POST['submit'])){
                if(!isset($_COOKIE[$this->cookie_name])){
                    setcookie($this->cookie_name,0, time()+(2400), "/");
                    return 0;
                } else {
                    $cookie_val =  $_COOKIE['question_id'];
                    setcookie($this->cookie_name, ++$cookie_val, time()+(2400), "/");
                    return $cookie_val;
                }
            } else {
                if(!isset($_COOKIE[$this->cookie_name])){
                    setcookie($this->cookie_name,0, time()+(2400), "/");
                    return 0;
                } else {
                    $cookie_val =  $_COOKIE['question_id'];
                    return $cookie_val;
                }
            }
                
                
        }
      
    }//end of question class
    $question = new question();
    $question->get_json();
?>