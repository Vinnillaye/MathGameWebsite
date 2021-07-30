<?php
include("digRound.php");
include("digArray.php");


class DigPick { //wrapper for list of rounds, with the option to change the round
  private $n_rounds; //amount of rounds to be played
  //private $score; //number of correct answers
  private $round_arr; //array of rounds to plaf
  //private $current_index; //index of current round
  //constructs a new game
  //private $current_round; //current round 

  private function __construct() {}


  public static function createGame($n_rounds, $ndig_low, $ndig_high, $b_low, $b_high) {
    $obj = new DigPick();
    $obj->n_rounds = $n_rounds;
    $obj->round_arr = array();
    for ($i = 0; $i < $n_rounds; $i++) {
      $base = rand($b_low, $b_high);
      $digits = rand($ndig_low, $ndig_high); 
      $round = Round::makeRoundDigBase($digits, $base);
      array_push(($obj->round_arr), $round);
    }
    return $obj;

  }

  /* useful for debug
  public function play() {
    foreach($this->round_arr as $round) {  
      echo("\nScore: ".($this->score));
      echo("\nNumber of base " . $round->getBase() .":\n");
      echo $round->getNumStr();
      echo("\n");
      $ans = readline("What is the digit in the ". $round->getPlace(). "s place? :");
      if ($this->decConvert($ans) == $round->getCorrect()) {
        echo "\nCorrect!\n";
        $this->score++;
      } else {
        echo "\nWrong!\n";
      }
    }
  }
  */

  public function answer($ans) { //returns 1 if correct, 0 if incorrect, move to the next round
    $val = 0;
    if ($this->decConvert($ans) == $current_round->getCorrect()) {
      $this->score += 1;
      $val = 1;
    }
    $this->current_index++;
    $this->current_round = ($this->round_arr)[$this->current_index];
    return $val;
  }

  //converts hex digits to decimal values
  public static function decConvert($dig) {
    switch ($dig) {
      case 'a':
        return 10;
      case 'b':
        return 11;
      case 'c':
        return 12;
      case 'd':
        return 13;
      case 'e':
        return 14;
      case 'f':
        return 15;
    }
    return $dig;
  }
    
  
  public function toJson() {
    $roundArray = array();
    foreach (($this->round_arr) as $round) {
        array_push($roundArray, $round->toArray());
    }
    $arr = array(
        "numRounds" => $this->n_rounds,
        "roundArray" => $roundArray,
    );
    return json_encode($arr);
  }

  public function getNumRounds() {
    return $this->n_rounds;
  }

  public function getRound($index) {
    return $this->round_arr[$index];
  }
  /*
  public function getScore() {
    return $this->score;
  }

  public function getCurrentRound() {
    return $this->current_round;
  }

  public function getCurrentRoundIndex() {
    return $this->current_index;
  }
  */
}