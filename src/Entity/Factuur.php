<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FactuurRepository")
 */
class Factuur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Bestelling", mappedBy="Factuur")
     */
    private $Bestelling;

    public function __construct()
    {
        $this->Bestelling = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Bestelling[]
     */
    public function getBestelling(): Collection
    {
        return $this->Bestelling;
    }

    public function addBestelling(Bestelling $bestelling): self
    {
        if (!$this->Bestelling->contains($bestelling)) {
            $this->Bestelling[] = $bestelling;
            $bestelling->setFactuur($this);
        }

        return $this;
    }

    public function removeBestelling(Bestelling $bestelling): self
    {
        if ($this->Bestelling->contains($bestelling)) {
            $this->Bestelling->removeElement($bestelling);
            // set the owning side to null (unless already changed)
            if ($bestelling->getFactuur() === $this) {
                $bestelling->setFactuur(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return strval($this->getId());
    }
}
