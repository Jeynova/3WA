<?php

namespace App\DateMatching;

class DateMatching{


  function matching($date){


  $now = new \DateTime();

  if($date> $now){
    return false;
  }
  else{
    return true;
  }
}

function overlap($d1,$d2,$d3,$d4){

  if( ($d2 <= $d3 || $d1 >= $d4) ){
    return false;
  }
  else{
    return true;
    
  }

}

}































 ?>
