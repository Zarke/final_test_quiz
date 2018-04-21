<?php
    include("question.php");
    class choosing extends question {
        private $img_sections = "img_section";//image sections that have been used
        private $question_selection = "question_difficulty";
        private $curr_question_set = array();
        private $fortress_arr = array();
        public function choose_action(){
            if(isset($_POST['rerun'])){
                $section = rand(0,3);
                $this->set_cookie($this->img_sections, serialize(array($section))) or die("Cookie nije tu!");
                choosing::redirect('quiz.php');
            } else if(isset($_POST['new_selection'])){
                setcookie($this->img_sections, '', time()-(2400), "/");
                setcookie($this->question_selection, '', time()-(2400), "/");
                choosing::redirect('index.php');
            }else if(isset($_POST['check'])){
                $this->curr_question_set = $this->get_cookie($this->question_set);
                foreach ($_POST['radio_btn'] as $answer) {
                    if(!in_array($answer,$this->curr_question_set)){
                        echo "Izabrali ste pogresnu tvrdjavu";
                    } else{
                        echo "Cestitamo, tvrdjava koju ste izabrali je tvrdjava sa slike";
                    }
                }
            }
        }

        //method taht lists all 
        public function checkbox_listing(){
            $this->get_json();
            $this->fortress_arr = $this->documents->{'lista tvrdajva'};
            foreach( $this->fortress_arr as $key => $value){
                echo "<input class='checkbox' id='".$key."' type='radio' name= 'radio_btn[]' value=" .$key.">"."<label for='".$key."'>".$value."</label>"."<br>";
            }
        }
        //method that cheks if the corect answer was chosen in the checkbox list
        public function checkbox_guess(){
            if(isset($_POST['fortress_guess'])){

            }
        }
        //method for redirecting to a certain page
        public static function redirect($location){
            header("Location: {$location}");
        }
    }//end of class redirect
    $choice = new choosing();
    $choice->choose_action();
?>