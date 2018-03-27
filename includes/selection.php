<?php
include("question.php");
    class question_selection extends question {
        private $url = null;
        private $data = null;
        private $documents = null;
        private $question_list_cookie_name = "question_list";
        private $question_amount = null;
        
        //method for extractinh the JSON file taht contains the questions
        public function get_json(){
            $this->url = 'questions.json';
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
            return $question_number/5;
        }

        //method that activates on page load that lists all question groups
        public function show_selections(){
            $this->question_amount();
            $selection_amount = $this->question_selection_partitioning($this->question_amount);
                $start_question = 1;
                $end_question = 5;
                echo "<h1 class=\"question\">Izaberite zeljenu grupu pitanja:</h1> <br>";
                for ($i=0; $i < $selection_amount; $i++) { 
                    echo "<input class='one' type='checkbox' name= 'checkbox[]' value='".$i."'>"."<span><p>Grupa pitanja ".$i.": ".$start_question."-". $end_question."</p></span>"."<br>";
                    $end_question +=5;
                    $start_question +=5;
                }  
        }

        public function set_selection_and_redirect(){
            if(isset($_POST['submit'])){
                if (empty($_POST['checkbox'])){
                    echo("<script>alert('Molim odaberite bar jednu od ponudjenih opcija')</script>");
                } else {
                    foreach ($_POST['checkbox'] as $answer) {
                        if(isset($answer)){
                           echo "Cekiran sam !!!";
                        }
                    }
                }
            }
        }

    }//end of selection class
    $selection = new question_selection();
    $selection->get_json();
?>