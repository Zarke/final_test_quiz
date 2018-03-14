<?php    
    class question {
        public $url = null;
        public $data = null;
        public $documents = null;
        public $id = 0;
        
        //extraction and formating of the json file
        public function get_json(){
            $this->url = 'document.json';
            $this->data = file_get_contents($this->url); 
            $this->documents = json_decode($this->data);
        }

        //method for printing the question
        public function get_question(){
           echo "<h1>".$this->documents->{0}->pitanje."</h1> <br>";
           foreach ($this->documents->{0}->moguci_odgovori as $key => $odgovor) {
               echo "<input type=\"checkbox\" name= \"correct[]\" value=" .$key.">".$odgovor."<br>";
               
           }
        }

      
    }//end of question class
    $question = new question();
   $question->get_json();
?>