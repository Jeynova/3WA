<?php

namespace App\Hello;

use App\Service\Magnify;



class HelloWorld{

private $prenom;
private $magnify;

  public function __construct(string $p,Magnify $m){
    $this->prenom=$p;
    $this->magnify = $m;
  }

  Public function yo(){

    return "Yo ! ".$this->prenom;

  }

  public function yoUpper(){
    return $this->magnify->upper($this->yo());
  }





}








?>
