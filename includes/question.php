<?php    
    class question {
        private $used_questions = "question_id";
        private $question_scope = "question_scope";
        private $url = null;
        private $data = null;
        private $documents = null;
        private $answers = array();//all correct answers
        private $unchecked_correct = array();//all checked correct answers
        private $id_answer = 0;
        private $question_id_array = array(0);
        
        //extraction and formating of the json file
        public function get_json(){
            $this->url = 'includes/questions.json';
            $this->data = file_get_contents($this->url); 
            $this->documents = json_decode($this->data);
        }

        //method for printing the question
        public function get_question(){
           $question_id = $this->randomisation();
           echo "<h1 class=\"question\">".$this->documents->{$question_id}->pitanje."</h1> <br>";
           foreach ($this->documents->{$question_id}->moguci_odgovori as $key => $odgovor) {
               echo "<input class=\"one\" type='checkbox' name= 'checkbox[]' value=" .$key.">"."<span><p>".$odgovor."</p></span>"."<br>";
               
           }
        }

        public function get_current_question(){
            $question_id_array = $this->get_cookie($this->used_questions);
            $current_question_id = end($question_id_array);
            $question_id = $current_question_id;
            echo "<h1 class=\"question\">".$this->documents->{$question_id}->pitanje."</h1> <br>";
           foreach ($this->documents->{$question_id}->moguci_odgovori as $key => $odgovor) {
               echo "<input class=\"one\" type='checkbox' name= 'checkbox[]' value=" .$key.">"."<span><p>".$odgovor."</p></span>"."<br>";
               
           }
        }
        //method for randomization of questions
        public function randomisation(){
            $start_end_question = $this->get_cookie($this->question_scope);
            $end_rand = end($start_end_question);
            $start_rand = $end_rand - 24;
            if(!isset($_COOKIE[$this->used_questions])){
                $this->set_cookie($this->used_questions,array($start_rand));
                return $start_rand;
            } else {
                $question_id_array = $this->get_cookie($this->used_questions);
                if(count($question_id_array) <25 && count($question_id_array)> 0){
                    $question_id = rand($start_rand,$end_rand);
                    if (in_array($question_id, $question_id_array))
                    {
                        return $this->randomisation();
                    }
                  else
                    {
                        array_push($question_id_array,$question_id);
                        $this->set_cookie($this->used_questions, $question_id_array);
                        return $question_id;
                    }
                } else {
                    echo "<script>alert(\"Dosli ste do kraja ovog dela testa\")</script>";
                    question::redirect("choice.php");
                }
            }
        }

        //method that checks if the selected random value is in the array extracted form the cookie
        public function check_question_id($question_id){
            
            $question_id_array = unserialize($this->get_cookie());
            foreach ($question_id_array as $index => $value) {
                if ($question_id == value){
                    return true;
                } else {
                    return false;
                }
            }
        }
        //Checks what answers are correct and tells the user what the mistake was and what is the correct answer
        public function check(){
                $last_question_id = $this->get_cookie($this->used_questions);
                $last_question_id_placeholder = end($last_question_id);
                $question_id_val = $last_question_id_placeholder;

                foreach ($this->documents->{$question_id_val}->tacni_odgovori as $answer) {
                    $this->answers[$this->id_answer] = $answer;
                    $this->id_answer ++;
                }
               
               $id_answer = 0;
               $unchecked_correct = $this->answers;
               
               if (empty($_POST['checkbox'])){
                    echo("<script>alert(\"Molim odaberite bar jedan od ponudjenih odgovora\")</script>");
               } else {
                foreach ($_POST['checkbox'] as $answer) {
                    if(in_array($answer , $this->answers)){
                        echo "<p class=\"true\">The answer: ". $this->documents->{$question_id_val}->moguci_odgovori->{$answer} ." is correct </p><br>";
                        $unchecked_correct = question::deleteElement($answer, $unchecked_correct);
                    } else {
                        echo "<p class=\"false\">The answer: ".$this->documents->{$question_id_val}->moguci_odgovori->{$answer} ." is not correct </p><br>";
                    }
                }//end of foreach lop hehe
                
                //loops all the unchecked correct answers
               foreach ($unchecked_correct as $correct) {
                   echo "<p class=\"should\">You shoud have also checked: ".$this->documents->{$question_id_val}->moguci_odgovori->{$correct}."</p><br>" ;
               } 
               }
              
        }

        //deletes an item from the copy of the correct answer array
        private static function deleteElement($element, $array){
            $index = array_search($element, $array);
            if($index !== false){
                unset($array[$index]);
            }
            return $array;
        }

        protected function get_cookie($question_name){
                return  unserialize($_COOKIE[$question_name]);
        }
        protected function set_cookie($cookie_name, $question_array){
            setcookie($cookie_name, serialize($question_array), time()+(2400), "/");
        }

        //method for redirecting to a certain page
        public static function redirect($location){
            header("Location: {$location}");
        }
      
    }//end of question class
    $question = new question();
    $question->get_json();
?>