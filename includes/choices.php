<?php
    class choosing {
        private $used_questions = "question_id";
        private $question_scope = "question_scope";
        public function choise(){
            if(isset($_POST['rerun'])){
                setcookie($this->used_questions, '', time()-(2400), "/");
                choosing::redirect('quiz.php');
            } else if(isset($_POST['new_selection'])){
                setcookie($this->used_questions, '', time()-(2400), "/");
                setcookie($this->question_scope, '', time()-(2400), "/");
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