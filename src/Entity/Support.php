<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SupportRepository")
 */
class Support
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
    private $supportType;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DetailCommande", mappedBy="support")
     */
    private $detailcommande_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Produit", inversedBy="support_id")
     */
    private $produit;

    public function __construct()
    {
        $this->detailcommande_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSupportType(): ?string
    {
        return $this->supportType;
    }

    public function setSupportType(string $supportType): self
    {
        $this->supportType = $supportType;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection|DetailCommande[]
     */
    public function getDetailcommandeId(): Collection
    {
        return $this->detailcommande_id;
    }

    public function addDetailcommandeId(DetailCommande $detailcommandeId): self
    {
        if (!$this->detailcommande_id->contains($detailcommandeId)) {
            $this->detailcommande_id[] = $detailcommandeId;
            $detailcommandeId->setSupport($this);
        }

        return $this;
    }

    public function removeDetailcommandeId(DetailCommande $detailcommandeId): self
    {
        if ($this->detailcommande_id->contains($detailcommandeId)) {
            $this->detailcommande_id->removeElement($detailcommandeId);
            // set the owning side to null (unless already changed)
            if ($detailcommandeId->getSupport() === $this) {
                $detailcommandeId->setSupport(null);
            }
        }

        return $this;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): self
    {
        $this->produit = $produit;

        return $this;
    }
}
