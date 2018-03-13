<?php    
    class question {
        public $url = null;
        public $data = null;
        public $documents = null;
        
        public function get_json(){
            $this->url = 'document.json';
            $this->data = file_get_contents($this->url); 
            $this->documents = json_decode($this->data);
        }

        public function show(){
            foreach ($this->documents as $document) {
                echo $document->pitanje."<br>";
                foreach ($document->moguci_odgovori as $option) {
                    echo $option . "<br>";
                }
           }
        }
    }//end of question class
    $question = new question();
   $question->get_json();
   $question->show();
?>