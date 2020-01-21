<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReservatieRepository")
 */
class Reservatie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="time")
     */
    private $Tijd;

    /**
     * @ORM\Column(type="date")
     */
    private $Datum;

    /**
     * @ORM\Column(type="integer")
     */
    private $Hoeveelheid;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
     */
    private $Gebruiker;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTijd(): ?\DateTimeInterface
    {
        return $this->Tijd;
    }

    public function setTijd(\DateTimeInterface $Tijd): self
    {
        $this->Tijd = $Tijd;

        return $this;
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

    public function getHoeveelheid(): ?int
    {
        return $this->Hoeveelheid;
    }

    public function setHoeveelheid(int $Hoeveelheid): self
    {
        $this->Hoeveelheid = $Hoeveelheid;

        return $this;
    }

    public function getGebruiker(): ?User
    {
        return $this->Gebruiker;
    }

    public function setGebruiker(?User $Gebruiker): self
    {
        $this->Gebruiker = $Gebruiker;

        return $this;
    }

    public function __toString()
    {
        return (string) $this->getId();
    }
}
