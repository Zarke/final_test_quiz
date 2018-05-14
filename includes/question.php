<?php    
    class question {
        private $used_questions = "question_id";
        private $question_scope = "question_scope";
        private $question_submit = "submited";
        protected $count = "submited_control_value";
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
            if(!isset($_COOKIE[$this->count])){
                echo "Doslo je do greske prilikom izvrsavanja koda, molimo vas da kontaktirate administratora sajta";
            } else{
                $count_arr = $this->get_cookie($this->count);
                $count_arr = count($count_arr);
                switch($count_arr){
                    case 1:
                    $this->question_print();
                    $control_value = $this->get_cookie($this->count);
                    array_push($control_value,1);
                    $this->set_cookie($this->count,$control_value);
                    break;

                    default:
                        $this->is_set_question_submit();
                    break;
                }
                
            }
        }

        //method for checking if the question has been allready answered
        private function is_set_question_submit(){
            if(!isset($_COOKIE[$this->question_submit]) ){
                echo("<script>alert('Molim vas da proverite tacnost trenutnog pitanja pre nastavka kviza')</script>");
                $this->get_current_question();
            } else{
                $this->question_print();
                setcookie($this->question_submit, "", time() -100, "/");
            }
        }
        //method for printing a question
        private function question_print(){
            
                $question_id = $this->randomisation();
                echo "<h3 class='question__form-heading center-align'>".$this->documents->{$question_id}->pitanje."</h3>";
                foreach ($this->documents->{$question_id}->moguci_odgovori as $key => $odgovor) {
                    echo "<input id='".$key."' type='checkbox' name= 'checkbox[]' value=" .$key.">"."<label          class='question__form-possible_answer' for='".$key."' >".$odgovor."</label>";
                }
        }

        public function get_current_question(){
            $question_id_array = $this->get_cookie($this->used_questions);
            $current_question_id = end($question_id_array);
            $question_id = $current_question_id;
            echo "<h3 class='question__form-heading center-align'>".$this->documents->{$question_id}->pitanje."</h3>";
           foreach ($this->documents->{$question_id}->moguci_odgovori as $key => $odgovor) {
            echo "<input id='".$key."' type='checkbox' name= 'checkbox[]' value=" .$key.">"."<label  class='question__form-possible_answer' for='".$key."' >".$odgovor."</label>";
               
           }
        }
        //method for randomization of questions
        public function randomisation(){
            $start_end_question = $this->get_cookie($this->question_scope);
            $end_rand = end($start_end_question);
            $start_rand = $end_rand - 49;
            if(!isset($_COOKIE[$this->used_questions])){
                $this->set_cookie($this->used_questions,array($start_rand));
                return $start_rand;
            } else {
                $question_id_array = $this->get_cookie($this->used_questions);
                if(count($question_id_array) <50 && count($question_id_array)> 0){
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
                    question::redirect("choice.php");
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
                        echo "<div class='question__answers-correct '>Odgovor:<b> ". $this->documents->{$question_id_val}->moguci_odgovori->{$answer} ." </b>je tačan </div>";
                        $unchecked_correct = question::deleteElement($answer, $unchecked_correct);
                        print_r($unchecked_correct);echo "Kad pogodis jedan tacan";
                    } else {
                        echo "<div class='question__answers-incorrect '>Odgovor: <b>". $this->documents->{$question_id_val}->moguci_odgovori->{$answer} ."</b> je netačan </div>";
                    }
                }//end of foreach lop
                
                //loops all the unchecked correct answers
               foreach ($unchecked_correct as $correct) {
                   echo "<div class='question__answers-unchecked '>Trebalo je odabrati: <b>". $this->documents->{$question_id_val}->moguci_odgovori->{$correct} ."</b></div>";
               } 
               }
               $this->set_cookie($this->question_submit,array(1));  
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
        protected function set_cookie($cookie_name, $array){
            setcookie($cookie_name, serialize($array), time()+(2400), "/");
        }

        //method for redirecting to a certain page
        public static function redirect($location){
            header("Location: {$location}");
        }
      
    }//end of question class
    $question = new question();
    $question->get_json();
?>