<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProduitRepository")
 */
class Produit
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
    private $title;

    /**
     * @ORM\Column(type="date")
     */
    private $productionDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Support", mappedBy="produit")
     */
    private $support_id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Streaming", mappedBy="produit_id")
     */
    private $streamings;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Artiste", inversedBy="produit_id")
     */
    private $artiste;

    public function __construct()
    {
        $this->support_id = new ArrayCollection();
        $this->streamings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getProductionDate(): ?\DateTimeInterface
    {
        return $this->productionDate;
    }

    public function setProductionDate(\DateTimeInterface $productionDate): self
    {
        $this->productionDate = $productionDate;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Support[]
     */
    public function getSupportId(): Collection
    {
        return $this->support_id;
    }

    public function addSupportId(Support $supportId): self
    {
        if (!$this->support_id->contains($supportId)) {
            $this->support_id[] = $supportId;
            $supportId->setProduit($this);
        }

        return $this;
    }

    public function removeSupportId(Support $supportId): self
    {
        if ($this->support_id->contains($supportId)) {
            $this->support_id->removeElement($supportId);
            // set the owning side to null (unless already changed)
            if ($supportId->getProduit() === $this) {
                $supportId->setProduit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Streaming[]
     */
    public function getStreamings(): Collection
    {
        return $this->streamings;
    }

    public function addStreaming(Streaming $streaming): self
    {
        if (!$this->streamings->contains($streaming)) {
            $this->streamings[] = $streaming;
            $streaming->setProduitId($this);
        }

        return $this;
    }

    public function removeStreaming(Streaming $streaming): self
    {
        if ($this->streamings->contains($streaming)) {
            $this->streamings->removeElement($streaming);
            // set the owning side to null (unless already changed)
            if ($streaming->getProduitId() === $this) {
                $streaming->setProduitId(null);
            }
        }

        return $this;
    }

    public function getArtiste(): ?Artiste
    {
        return $this->artiste;
    }

    public function setArtiste(?Artiste $artiste): self
    {
        $this->artiste = $artiste;

        return $this;
    }
}
