<?php
class DigArray {
  //members
  private $digits;
  private $base;
  private $num_array; //a number representation using an array
  private $decimal; //the decimal value
  private $str_rep;
  //constructor
  //defaults to three digit base 10
  /*public function __construct() {
    $this->digits = 3;
    $this->base = 10;
    $this->num_array = $this->genNum(3, 10);
    $this->decimal = $this->calcDecimal($this->num_array, 3, 10);
  }*/

  public function __construct($d, $b) {
    $this->digits = $d;
    $this->base = $b;
    $na = $this->genNum($d, $b);
    $this->num_array = $na;
    $this->decimal = $this->calcDecimal($na, $d, $b);
    $this->str_rep = $this->toStr($na);
  }

  // generates an array of digits given number of digits and base, alphabetical digits are stored as numbers
  private static function genNum($n_dig, $b) {
    if ($n_dig < 1) {
      throw new Exception("Cannot generate number with less than one digit");
    } else if ($b < 2) {
      throw new Exception("Cannot generate number of base less than 2");
    } else if ($b > 16) {
      throw new Exception("Cannot generate number of base greater than 16");
    } else {
      $num = array();
      for ($i = 0; $i < $n_dig; $i++) {
        $num[$i] = rand(0,($b - 1));
      }
      return $num;
    }
  }
  
  //calculates decimal value of the number stored
  private static function calcDecimal($num_arr, $n_dig, $b) {
    $sum = 0;
    for ($i = 0; $i < $n_dig; $i++) {
      $sum += $num_arr[$i] * pow($b, $i);
    }
    return $sum;
  }

  //returns a string representation of the array with hex chars if needed
  private function toStr($arr) {
    $modified = array();
    $len = count($arr);
    for ($i = 0; $i < $len; $i++) {
      $cur = $arr[$len-$i-1];
      $modified[$i] = $this->hexTransform($cur);
    }
    return implode("", $modified);
  }

  private function hexTransform($digit) {
  if ($digit > 9) {
    switch ($digit) {
      case 10:
        return "a";
      case 11:
        return "b";
      case 12:
        return "c";
      case 13:
        return "d";
      case 14:
        return "e";
      case 15:
        return "f";
    }
  } else {
    return $digit;
  }
}

  public function getNumDigits() {
    return $this->digits;
  }
  public function getBase() {
    return $this->base;
  }
  public function getArray() {
    return $this->num_array;
  }
  public function getDecimal() {
    return $this->decimal;
  }
  
  public function getDigit($index) {
    return ($this->num_array)[$index];
  }

  public function getStr() {
    return $this->str_rep;
  }
}
