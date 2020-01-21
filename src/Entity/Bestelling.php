<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BestellingRepository")
 */
class Bestelling
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $Datum;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Gerecht")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Gerecht;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Reservatie")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Reservatie;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Factuur", inversedBy="Bestelling")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Factuur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatum(): ?\DateTimeInterface
    {
        return $this->Datum;
    }

    public function setDatum(\DateTimeInterface $Datum): self
    {
        $this->Datum = $Datum;

        return $this;
    }

    public function getGerecht(): ?Gerecht
    {
        return $this->Gerecht;
    }

    public function setGerecht(?Gerecht $Gerecht): self
    {
        $this->Gerecht = $Gerecht;

        return $this;
    }

    public function getReservatie(): ?Reservatie
    {
        return $this->Reservatie;
    }

    public function setReservatie(?Reservatie $Reservatie): self
    {
        $this->Reservatie = $Reservatie;

        return $this;
    }

    public function getFactuur(): ?Factuur
    {
        return $this->Factuur;
    }

    public function setFactuur(?Factuur $Factuur): self
    {
        $this->Factuur = $Factuur;

        return $this;
    }

    public function __toString()
    {
        return (string) $this->getId();
    }
}
