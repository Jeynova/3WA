<?php

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event ;
use App\Entity\User;


class RegisterEvent extends Event{

  public const NAME= 'user.register';

  private $user;

  public function __construct(User $user){

    $this->user=$user;
  }
  public function getUser(){

    return $this->user;
  }
}

 ?>
