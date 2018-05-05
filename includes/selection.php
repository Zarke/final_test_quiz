<?php
include("question.php");
    class question_selection extends question {
        private $url = null;
        private $data = null;
        private $documents = null;
        private $cookie_name= "question_scope";
        private $question_amount = null;
        public $question_set_array = array();
        
        //method for extractinh the JSON file taht contains the questions
        public function get_json(){
            $this->url = 'includes/questions.json';
            $this->data = file_get_contents($this->url); 
            $this->documents = json_decode($this->data);
        }

        //method for counting the question amount
        private function question_amount(){
            foreach($this->documents as $id => $question){
                $this->question_amount ++;
            }
        }

        //method that tells us how many question groups there are based on the division
        private function question_selection_partitioning($question_number){
            return $question_number/25;
        }

        //method that activates on page load that lists all question groups
        public function show_selections(){
            $this->question_amount();
            $selection_amount = $this->question_selection_partitioning($this->question_amount);
                $start_question = 1;
                $end_question = 25;
                echo "<h1 class='section_choice__form-heading center-align'>Izaberite zeljenu grupu pitanja</h1>";
                for ($i=1; $i <= $selection_amount; $i++) { 
                    // echo "<input class='begininput' type='checkbox' name= 'checkbox[]' value='".$end_question."'>"."<span><p>Grupa pitanja ".$i.": ".$start_question."-". $end_question."</p></span>"."<br>";
                    echo "<input id='".$end_question."' type='checkbox' name='checkbox[]' value='".$end_question."'>"."<label class='section_choice__form-option' for='".$end_question."'>Grupa pitanja: ".$start_question." - ".$end_question."</label>";
                    $end_question +=25;
                    $start_question +=25;
                }  
        }

        public function set_selection_and_redirect(){
            if(isset($_POST['submit'])){
                if (empty($_POST['checkbox'])){
                    echo("<script>alert('Molim odaberite bar jednu od ponudjenih opcija')</script>");
                } else {
                    foreach ($_POST['checkbox'] as $answer) {
                        if(isset($answer)){
                        $this->question_set_array[] = $answer;
                        $this->set_cookie($this->cookie_name,$this->question_set_array);
                        self::redirect("quiz.php");
                        }
                    }
                }
            }
        }

    }//end of selection class
    $selection = new question_selection();
    $selection->get_json();
?>