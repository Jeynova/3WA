<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"user" = "User", "client" = "Client", "admin" = "Admin"})
 * @UniqueEntity(fields={"screenName"}, message="There is already an account with this screenName")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $screenName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="json")
     */
    private $roles=[];


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScreenName(): ?string
    {
        return $this->screenName;
    }

    public function setScreenName(string $screenName): self
    {
        $this->screenName = $screenName;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): array
    {
      $roles=$this->roles;
      // $roles=array("ROLE_USER");
      // $this->roles = (!$roles) ? ["ROLE_USER"] : $roles;
      return array_unique($roles);
    }

    public function setRoles(?array $roles): self
    {

        $this->roles = (empty($roles)) ? ["ROLE_USER"] : $roles;

        return $this;
    }


    public function getSalt(){

    }

    public function getUsername() {
      return $this->screenName;
    }

    public function eraseCredentials() {

    }

}
