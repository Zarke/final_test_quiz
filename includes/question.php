<?php    
    class question {
        private $img_sections = "img_section";//image sections that have been used
        private $question_ids = "question_ids";
        private $question_difficulty = "question_difficulty";
        private $url = null;
        private $data = null;
        private $documents = null;
        private $answers = array();//all correct answers
        private $unchecked_correct = array();//all checked correct answers
        private $id_answer = 0;
        private $question_id_array = array(0);
        
        //extraction and formating of the json file
        public function get_json(){
            $this->url = 'includes/culture.json';
            $this->data = file_get_contents($this->url); 
            $this->documents = json_decode($this->data);
        }

        //method for printing the question
        public function get_question(){
            $question_id = $this->randomisation();//the random number of the question
            // here we set the question_ids cookie used in get_current_question method to make sure that the same question getrs printed
            if(!isset($_COOKIE[$this->question_ids])){
                $this->set_cookie($this->question_ids,array($question_id));
            }else{
                $arr_of_question_ids = $this->get_cookie($this->question_ids);
                array_push($arr_of_question_ids,$question_id); 
                $this->set_cookie($this->question_ids,$arr_of_question_ids);
            }
            $quiz_section = $this->get_cookie($this->question_difficulty);
            $quiz_section_id = $quiz_section[0];//id of the current section
            if(!isset($_COOKIE[$this->img_sections])){
                echo "<h1 class=\"question\">".$this->documents->{$quiz_section_id}->{0}->{"section questions"}->{$question_id}->{"pitanje"}."</h1> <br>";
                foreach ($this->documents->{$quiz_section_id}->{0}->{"section questions"}->{$question_id}->{"moguci_odgovori"} as $key => $odgovor) {
                    echo "<input class=\"one\" type='checkbox' name= 'checkbox[]' value=" .$key.">"."<span><p>".$odgovor."</p></span>"."<br>";
                }   
            }else{
                $curr_img_section = $this->last_arr_elem($this->img_sections);//we extract the last element of the sections array
                echo "<h1 class=\"question\">".$this->documents->{$quiz_section_id}->{$curr_img_section}->{"section questions"}->{$question_id}->{"pitanje"}."</h1> <br>";
                foreach ($this->documents->{$quiz_section_id}->{$curr_img_section}->{"section questions"}->{$question_id}->{"moguci_odgovori"} as $key => $odgovor) {
                    echo "<input class=\"one\" type='checkbox' name= 'checkbox[]' value=" .$key.">"."<span><p>".$odgovor."</p></span>"."<br>";
                }
            } 
        }

        //method for printing the current qestion for which we are checking the answer
        public function get_current_question(){
            $question_id_array = $this->get_cookie($this->question_ids);
            //depending on the size of the array we choose which element to take

            if(count($question_id_array) == 1){
                $current_question_id = $question_id_array[0];
            } else {
                $current_question_id = end($question_id_array);
            }
            $quiz_section = $this->get_cookie($this->question_difficulty);
            $quiz_section_id = $quiz_section[0];

            $curr_img_section_array = $this->get_cookie($this->img_sections);

            if(count($curr_img_section_array) == 1){
                $curr_img_section = $curr_img_section_array[0];
            } else {
                $curr_img_section = $curr_img_section_array[count($curr_img_section_array)-2];
            }
            echo "<h1 class=\"question\">".$this->documents->{$quiz_section_id}->{$curr_img_section}->{"section questions"}->{$current_question_id}->{"pitanje"}."</h1> <br>";
            foreach ($this->documents->{$quiz_section_id}->{$curr_img_section}->{"section questions"}->{$current_question_id}->{"moguci_odgovori"} as $key => $odgovor) {
                echo "<input class=\"one\" type='checkbox' name= 'checkbox[]' value=" .$key.">"."<span><p>".$odgovor."</p></span>"."<br>";
            }
        }
        //method for randomization of questions
        public function randomisation(){ 
        
            if(!isset($_COOKIE[$this->img_sections])){
                // $section_id = rand(0,3);
                // $this->set_cookie($this->img_sections,array($section_id));
                $question_id = rand(0,1);//randomisation of the question id of the question to be displayed
                return $question_id;  
            } else {
                $img_sections_array = $this->get_cookie($this->img_sections);//array of all image sections that have been allready used
                $section_id = rand(0,3); //image section id is randomly generated
                if(count($img_sections_array) < 4){
                    if (in_array($section_id, $img_sections_array)){
                        return $this->randomisation();                      
                    } else{
                        print_r(implode(" ",$img_sections_array)." ovo je posle appendovanja");
                        array_push($img_sections_array,$section_id);
                        print_r(implode(" ",$img_sections_array)." ovo je posle appendovanja");
                        $this->set_cookie($this->img_sections, $img_sections_array);
                        $key = rand(0,1);
                        return $key;
                    }
                } else if(count($img_sections_array)== 4){
                    array_push($img_sections_array,$section_id);
                    $this->set_cookie($this->img_sections, $img_sections_array);
                    $key = rand(0,1);
                    return $key;
                  }
                  else{
                    question::redirect("choice.php");
                  }
              }
        }

        //Checks what answers are correct and tells the user what the mistake was and what is the correct answer
        public function check(){
            $question_id_array = $this->get_cookie($this->question_ids);
            //depending on the size of the array we choose which element to take
            if(count($question_id_array) == 1){
                $current_question_id = $question_id_array[0];
                echo "ID pitanja je prvi element".$current_question_id;

            } else {
                $current_question_id = end($question_id_array);
            }

            $quiz_section = $this->get_cookie($this->question_difficulty);
            $quiz_section_id = $quiz_section[0];//id of the current section

            $curr_img_section_array = $this->get_cookie($this->img_sections);//aquisition of the current image section

            if(count($curr_img_section_array) == 1){
                $curr_img_section = $curr_img_section_array[0];
                echo "ID sekcije je prvi element".$curr_img_section;
            } else {
                $curr_img_section = $curr_img_section_array[count($curr_img_section_array)-2];
            }
            foreach ($this->documents->{$quiz_section_id}->{$curr_img_section}->{"section questions"}->{$current_question_id}->{"tacni_odgovori"} as $answer) 
            {
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
                        echo "<p class=\"true\">The answer: ". $this->documents->{$quiz_section_id}->{$curr_img_section}->{"section questions"}->{$current_question_id}->{"moguci_odgovori"}->{$answer} ." is correct </p><br>";
                        $unchecked_correct = question::deleteElement($answer, $unchecked_correct);
                    } else {
                        echo "<p class=\"false\">The answer: ".$this->documents->{$quiz_section_id}->{$curr_img_section}->{"section questions"}->{$current_question_id}->{"moguci_odgovori"}->{$answer}." is not correct </p><br>";
                    }
                }//end of foreach lop hehe
                
                //loops all the unchecked correct answers
               foreach ($unchecked_correct as $correct) {
                   echo "<p class=\"should\">You shoud have also checked: ".$this->documents->{$quiz_section_id}->{$curr_img_section}->{"section questions"}->{$current_question_id}->{"moguci_odgovori"}->{$answer}."</p><br>" ;
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

        private function last_arr_elem($arr_name){
            $full_array = $this->get_cookie($arr_name);
            $last_elem = end($full_array);
            print_r(count($full_array));
            return $last_elem;
        }

        protected function get_cookie($question_name){
                return unserialize($_COOKIE[$question_name]);
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