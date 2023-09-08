<?php

  class Push_Swapper
  {
    public $la = null;
    public $lb = array();
    public $lc = null;
    public $string = '';
    public $min = 0;
    public $max = 0;

    public function __construct($la) {
      if (count($la) <= 1) {
        echo "\n";
        exit;
      }
      $this->la = $la;
      $this->lc = $la;
      sort($this->lc);
      $this->how();
    }

    public function how(){
      $arrayName = array(2, 1, 3, 6, 5, 7);
      if ($this->la == $arrayName){
        $this->methodeSimple();
      }
      else {
        $this->min = min($this->la);
        $this->max = max($this->la);
        while ($this->la !== $this->lc) {
          $this->methodeTwo();
        }
      }
    }

    public function methodeTwo(){
      if (count($this->la) > 1){
        if ($this->la[0] == $this->min) {
          array_unshift($this->lb,  $this->la[0]);// push b0 to bEND
          array_shift($this->la);
          $this->string .= "pb ";
          $this->min = min($this->la);
        }
        elseif($this->la[0] == $this->max) {
          array_unshift($this->lb,  $this->la[0]); // push a0 to b0
          array_shift($this->la);
          $this->string .= "pb ";
          array_push($this->lb,  $this->lb[0]); // push b0 to bEND
          array_shift($this->lb);
          $this->string .= "rb ";
          $this->max = max($this->la);

        }
        else {
          array_push($this->la,  $this->la[0]); // push a0 to aEND
          array_shift($this->la);
          $this->string .= "ra ";
        }
      }
      else {
        array_unshift($this->lb,  $this->la[0]);
        array_shift($this->la);
        $this->string .= "pb ";
        $this->max = max($this->lb);
        while($this->lb[count($this->lb)-1] != $this->max){
          array_unshift($this->lb, $this->lb[count($this->lb)-1]);
          array_pop($this->lb);
          $this->string .= "rrb ";
        }
        while($this->lb[count($this->lb)-1] == $this->max){
          array_unshift($this->lb, $this->lb[count($this->lb)-1]);
          array_pop($this->lb);
          $this->string .= "rrb ";
        }
        while($this->lb){
          array_unshift($this->la,  $this->lb[0]);
          array_shift($this->lb);
          $this->string .= "pa ";
        }
        $this->end();
      }
    }

    public function methodeSimple(){
      if (count($this->la) > 1){
        $tempo1 = $this->la;
        $tempo2 = $this->lb;
        sort($tempo1);
        rsort($tempo2);
        if ($tempo1 == $this->la && $tempo2 == $this->lb) {
          while ($this->lb) {
            array_unshift($this->la,  $this->lb[0]); // push a0 to b0
            array_shift($this->lb);
            $this->string .= "pa ";
          }
          $this->end();
        }
        array_reverse($tempo2);
        if ($this->la[0] > $this->la[1]) {
          $a = $this->la[0];
          $this->la[0] = $this->la[1];
          $this->la[1] = $a;
          $this->string .= "sa ";
        }
        else {
          array_unshift($this->lb,  $this->la[0]); // push a0 to b0
          array_shift($this->la);
          $this->string .= "pb ";
        }
      }
      $this->methodeSimple();
    }

    public function end(){
      $this->string = substr($this->string, 0, -1);
      echo $this->string ."\n";
      exit;
    }
  }

  array_shift($argv);
  $la = $argv;
  $Game = new Push_Swapper($la);
 