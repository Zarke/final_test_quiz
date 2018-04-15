<?php
    class choosing {
        private $img_sections = "img_section";//image sections that have been used
        private $question_selection = "question_difficulty";
        public function choise(){
            if(isset($_POST['rerun'])){
                $kurac = rand(0,3);
                setcookie($this->img_sections, serialize(array($kurac)), time()+(2400), "/") or die("Cookie nije tu!");
                choosing::redirect('quiz.php');
            } else if(isset($_POST['new_selection'])){
                setcookie($this->img_sections, '', time()-(2400), "/");
                setcookie($this->question_selection, '', time()-(2400), "/");
                choosing::redirect('index.php');
            }
        }

        //method for redirecting to a certain page
        public static function redirect($location){
            header("Location: {$location}");
        }
    }//end of class redirect
    $choice = new choosing();
    $choice->choise();
?>