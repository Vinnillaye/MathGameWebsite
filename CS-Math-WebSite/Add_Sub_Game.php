<?php
include_once ("QuestionGenerator.php"); 
class AddSubGame{
    
    
    // private $score; //number of questions answered correctly 
     private $lvl_difficulty; // (1-3) 1 = single digit, 2 = double digit, 3 = mix,  
     private $n_questions; //number of questions for the level
     private $g_mode; //gamemode 0 = addition, 1 = subtraction
     //private $current_round; //round we are currently on
     //private $question_file; //file to pull questions from 
     private  $num1_array = array();
     private  $num2_array = array(); 
     private $gen; 
     private $ans;
     
     private function __construct(){
    
    }
    
    public static function createGame($lvl_difficulty,$n_questions, $g_mode){
        $obj = new AddSubGame();
        $obj->lvl_difficulty = $lvl_difficulty;  
        $obj->n_questions = $n_questions; 
        $obj->g_mode = $g_mode;
        $gen = QuestionGen :: GenerateQuestions($lvl_difficulty,$n_questions,$g_mode); 
        $obj->num1_array = $gen->getNum1(); 
        $obj->num2_array = $gen->getNum2(); 
        
        //$gen = new QuestionGen($obj->lvl_difficulty, $obj->n_questions,$obj->g_mode);
        //$obj->num1_array = $gen->getNum1();
        //$obj->num2_array = $gen->getNum2(); 
        //print_r($obj->num1_array);      
        //print_r($obj->num2_array);
        return $obj; 
    }
       
    // function qGen (){
    //   $gen = new QuestionGen($this->lvl_difficulty, $this->n_questions, $this->g_mode); 
    //   $num1_array = $gen->getNum1(); 
    //   $num2_array = $gen->getNum2();
    //   print_r($num1_array);      
    //   print_r($num2_array);
    // }

    function toJson(){ 
      // print_r($this->num1_array); 
      // print_r($this->num2_array);  
      $arr = array(
         "Op1" => $this->num1_array, 
         "Op2" => $this->num2_array,
         "numQ" => $this->n_questions, 
      );  

      return json_encode($arr); 
    }
}
    
   
    
    
  

    
 
?>