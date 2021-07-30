<?php
class Round {
  private $base;
  private $digits;
  private $num;
  private $which_dig;
  private $place;
  private $correct;
  private $num_str;
 
  //constructs a new round
  private function __construct() {}

  public static function makeRoundFromJSON($json) {
    $obj = new Round();
    $jsonarr = var_dump(json_decode($json));
    $obj->digits = jsonarr["digits"];
    $obj->base = jsonarr["base"];
    $obj->which_dig = jsonarr["which_dig"];
    $obj->place = jsonarr["place"];
    $obj->correct = jsonarr["correct"];
    $obj->num_str = jsonarr["string"] ;
    return $obj;
  }

  public static function makeRoundDigBase($d, $b) {
    $obj = new Round();
    $obj->digits = $d;
    $obj->base = $b;
    $obj->num = new DigArray($d, $b);
    $obj->which_dig = rand(0,($d-1));
    $obj->place = pow($b, $obj->which_dig);
    $obj->correct = $obj->num->getDigit($obj->which_dig);
    $obj->num_str = $obj->num->getStr();
    return $obj;
  }
  /*
  public function toJson()  {
    $arr = array();
    $arr["string"] = $this->num_str;
    $arr["place"] = strval($this->place);
    $arr["digits"] = strval($this->digits);
    $arr["base"] = strval($this->base);
    $arr["correct"] = strval($this->correct);
    $arr["which_dig"] = strval($this->which_dig);
    return json_encode($arr);
  }
  */
  public function toArray() {
    $arr = array();
    $arr["string"] = $this->num_str;
    $arr["place"] = strval($this->place);
    $arr["digits"] = strval($this->digits);
    $arr["base"] = strval($this->base);
    $arr["correct"] = strval($this->correct);
    $arr["which_dig"] = strval($this->which_dig);
    return $arr;
  }

  public function getNumDigits() {
    return $this->digits;
  }
  public function getBase() {
    return $this->base;
  }
  
  public function getPlace() {
    return $this->place;
  }
  
  public function getCorrect() {
    return $this->correct;
  }

  public function getWhichDig() {
    return $this->which_dig;
  }

  public function getNumStr() {
    return $this->num_str;
  }

}