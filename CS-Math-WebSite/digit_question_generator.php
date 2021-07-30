<?php

Class QuestionGen{

    private $lvl_difficulty; 
    private $n_questions;
    private $g_mode;  
    private $num1_array = array(); 
    private $num2_array = array(); 
   
   
    public function __Construct(){

    }

    public static function GenerateQuestions($lvl_difficulty, $n_questions, $g_mode){
        $obj = new QuestionGen (); 
        $obj->lvl_difficulty = $lvl_difficulty;
        $obj->n_questions = $n_questions;
        $obj->g_mode = $g_mode; 
        if($obj->lvl_difficulty == 1){
            // echo("lvl1"); 
            $obj->lvl1(); 
        }
        else if ($obj->lvl_difficulty == 2){
            $obj->lvl2(); 
        }
        else {
            // echo("lvl3"); 
            $obj->lvl3();
        }
        return $obj;
    }

      private function lvl1(){
        if($this->g_mode == 0){
            for ($i = 0; $i < $this->n_questions; $i++){
                array_push($this->num1_array, rand(1,9)); 
                array_push($this->num2_array, rand(1,9)); 
            }
        }
        else{
            for ($i = 0; $i < $this->n_questions; $i++){
              $rand1 = rand(1,9); 
              $rand2 = rand(1,9); 
              if ($rand1 > $rand2){
                  array_push($this->num1_array, $rand1); 
                  array_push($this->num2_array, $rand2); 
              }
              else{
                array_push($this->num2_array, $rand1); 
                array_push($this->num1_array, $rand2);
              }   
            }
        }
    }

      private function lvl2(){
       if($this->g_mode == 0){
           for ($i = 0; $i < $this->n_questions; $i++){
               array_push($this->num1_array, rand(10,20)); 
               array_push($this->num2_array, rand(10,20)); 
           }
        }
        else{
            for ($i = 0; $i < $this->n_questions; $i++){
              $rand1 = rand(10,20); 
              $rand2 = rand(10,20); 
              if ($rand1 > $rand2){
                  array_push($this->num1_array, $rand1); 
                  array_push($this->num2_array, $rand2); 
              }
              else{
                array_push($this->num2_array, $rand1); 
                array_push($this->num1_array, $rand2);
              }   
            }
        }
    }

     private function lvl3(){
        if($this->g_mode == 0){
            for ($i = 0; $i < $this->n_questions; $i++){
                array_push($this->num1_array, rand(1,20)); 
                array_push($this->num2_array, rand(1,20));
            }
        }
        else{
            for ($i = 0; $i < $this->n_questions; $i++){
              $rand1 = rand(1,20); 
              $rand2 = rand(1,20); 
              if ($rand1 > $rand2){
                  array_push($this->num1_array, $rand1); 
                  array_push($this->num2_array, $rand2); 
              }
              else{
                array_push($this->num2_array, $rand1); 
                array_push($this->num1_array, $rand2);
              }   
            }
        }
    }

        



     public function getNum1(){
        return $this->num1_array; 
    }

     public function getNum2(){
        return $this->num2_array; 
    }








}

















?>