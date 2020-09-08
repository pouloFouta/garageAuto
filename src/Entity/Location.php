<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Vehicule;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LocationRepository")
 */
class Location
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_location;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $nb_jours;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $prix;


    /**
     * @ORM\ManyToOne(targetEntity="User" ,inversedBy="locations")
     * @ORM\JoinColumn(nullable=true)
     */

    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Vehicule", inversedBy="locations",cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid
     */
    private $vehicule;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statutLocation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateLocation(): ?\DateTimeInterface
    {
        return $this->date_location;
    }

    public function setDateLocation(\DateTimeInterface $date_location): self
    {
        $this->date_location = $date_location;

        return $this;
    }

    public function getNbJours(): ?int
    {
        return $this->nb_jours;
    }

    public function setNbJours(int $nb_jours): self
    {
        $this->nb_jours = $nb_jours;

        return $this;
    }

    public function getPrix()
    {
        return $this->prix;
    }

    public function setPrix($prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getVehicule(): ?Vehicule
    {
        return $this->vehicule;
    }

    public function setVehicule(?Vehicule $vehicule): self
    {
        $this->vehicule = $vehicule;

        return $this;
    }

    public function getStatutLocation(): ?string
    {
        return $this->statutLocation;
    }

    public function setStatutLocation(string $statutLocation): self
    {
        $this->statutLocation = $statutLocation;

        return $this;
    }
}
