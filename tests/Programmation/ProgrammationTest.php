<?php

namespace App\Tests\Programmation;


use App\DateMatching\DateMatching;
use PHPUnit\Framework\TestCase;

class DateMatchingTest extends TestCase
{

  private $dateMatching;

  public function dateProvider(){
    $schema=['Date1'=>[new \DateTime("-30 days"),true],'Date2'=>[new \DateTime("+30 days"),false]];
    return $schema;
  }

  public function overlapProvider(){
return [
           'date1' => [new \DateTime('1997-06-04'), new \DateTime('1997-06-10'),new \DateTime('1997-06-08'),new \DateTime('1997-06-12'), true],
           'date2' => [new \DateTime('2007-06-04'), new \DateTime('2007-06-10'),new \DateTime('2007-06-11'),new \DateTime('2007-06-12'), false],
           'date3' => [new \DateTime('2007-06-04'), new \DateTime('2007-06-10'),new \DateTime('2007-05-31'),new \DateTime('2007-06-03'), false],
       ];
  }

  public function setUp(){
    $this->dateMatching = new DateMatching();

  }

  /**
   * @dataProvider dateProvider
   */
  public function testDateMatching($date,$truth)
  {

    $result = $this->dateMatching->matching($date);
    $this->assertEquals($truth,$result);

  }

  /**
   * @dataProvider overlapProvider
   */
  public function testOverlapingDate($d1,$d2,$d3,$d4,$truth){
     $result =  $this->dateMatching->overlap($d1,$d2,$d3,$d4);
     $this->assertEquals($truth,$result);
  }


public function  tearDown(){
  $this->datematching = Null;
}
}
