<?php
include("question.php");
    class question_selection extends question {
        protected $url = null;
        protected $data = null;
        protected $documents = null;//where the decoded json is stored
        public $cookie_selection= "question_set";
        private $selection_num = null;//number of question selections
        public $question_set_array = array();
        
        //method for extractinh the JSON file taht contains the questions
        public function get_json(){
            $this->url = 'includes/culture.json';
            $this->data = file_get_contents($this->url); 
            $this->documents = json_decode($this->data);
        }

        //method for counting the question amount
        private function question_amount(){
            foreach($this->documents as $id => $question){
                $this->selection_num ++;
            }
        }

        // //method that tells us how many question groups there are based on the division
        // private function question_selection_partitioning($question_number){
        //     return $question_number/25;
        // }

        //method that activates on page load that lists all question groups
        public function show_selections(){
            $this->question_amount();
                echo "<h1 class=\"caption\">Izaberite željenu sliku:</h1> <br>";
                for ($i=0; $i <= $this->selection_num; $i++) { 
                    switch ($i) {
                        case 0:
                            echo "<input class='begininput' id='".$i."' type='checkbox' name= 'checkbox[]' value='".$i."'>"."<label for='".$i."'>Istorija banata</label>"."<br>";
                            break;
                        case 1:
                            echo "<input class='begininput' id='".$i."' type='checkbox' name= 'checkbox[]' value='".$i."'>"."<label for='".$i."'>istorija beogradskog pasaluka</label>"."<br>";
                            break;
                    }
                }  
        }

        public function set_selection_and_redirect(){
            if(isset($_POST['submit'])){
                if (empty($_POST['checkbox'])){
                    echo("<script>alert('Molim odaberite bar jednu od ponuđenih opcija')</script>");
                } else {
                    foreach ($_POST['checkbox'] as $answer) {
                        if(isset($answer)){
                        $this->question_set_array[] = $answer;
                        $this->set_cookie($this->cookie_selection,$this->question_set_array);
                        $section_id = rand(0,3);
                        $answer = json_encode($answer);
                        setcookie("img_id", $answer, time()+(2400), "/");
                        $this->set_cookie("img_section",array($section_id));
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