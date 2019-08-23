<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DetailCommandeRepository")
 */
class DetailCommande
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $orderNumber;

    /**
     * @ORM\Column(type="integer")
     */
    private $supportNumber;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Commande", inversedBy="detailCommandes")
     */
    private $commande_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Support", inversedBy="detailcommande_id")
     */
    private $support;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderNumber(): ?int
    {
        return $this->orderNumber;
    }

    public function setOrderNumber(int $orderNumber): self
    {
        $this->orderNumber = $orderNumber;

        return $this;
    }

    public function getSupportNumber(): ?int
    {
        return $this->supportNumber;
    }

    public function setSupportNumber(int $supportNumber): self
    {
        $this->supportNumber = $supportNumber;

        return $this;
    }

    public function getCommandeId(): ?Commande
    {
        return $this->commande_id;
    }

    public function setCommandeId(?Commande $commande_id): self
    {
        $this->commande_id = $commande_id;

        return $this;
    }

    public function getSupport(): ?Support
    {
        return $this->support;
    }

    public function setSupport(?Support $support): self
    {
        $this->support = $support;

        return $this;
    }
}
