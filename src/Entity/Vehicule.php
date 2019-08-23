<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VehiculeRepository")
 */
class Vehicule
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=17, unique=true)
     */
    private $numero_chassis;

    /**
     * @ORM\Column(type="string", length=9)
     */
    private $immatriculation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $marque;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $couleur;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $carburant;

    /**
     * @ORM\Column(type="integer")
     */
    private $kilometrage_achat;

    /**
     * @ORM\Column(type="integer")
     */
    private $kilometrage_actuel;


    /**
     * @ORM\ManyToOne(targetEntity="Client" ,inversedBy="vehicules")
     */

    private $client;

    /**
     * @ORM\OneToMany(targetEntity="Reparation" ,mappedBy="numeroChassis")
     */

    private $lesReparations;

    public function __construct()
    {
        $this->lesReparations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroChassis(): ?string
    {
        return $this->numero_chassis;
    }

    public function setNumeroChassis(string $numero_chassis): self
    {
        $this->numero_chassis = $numero_chassis;

        return $this;
    }

    public function getImmatriculation(): ?string
    {
        return $this->immatriculation;
    }

    public function setImmatriculation(string $immatriculation): self
    {
        $this->immatriculation = $immatriculation;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getCarburant(): ?string
    {
        return $this->carburant;
    }

    public function setCarburant(string $carburant): self
    {
        $this->carburant = $carburant;

        return $this;
    }

    public function getKilometrageAchat(): ?int
    {
        return $this->kilometrage_achat;
    }

    public function setKilometrageAchat(int $kilometrage_achat): self
    {
        $this->kilometrage_achat = $kilometrage_achat;

        return $this;
    }

    public function getKilometrageActuel(): ?int
    {
        return $this->kilometrage_actuel;
    }

    public function setKilometrageActuel(int $kilometrage_actuel): self
    {
        $this->kilometrage_actuel = $kilometrage_actuel;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return Collection|Reparation[]
     */
    public function getLesReparations(): Collection
    {
        return $this->lesReparations;
    }

    public function addLesReparation(Reparation $lesReparation): self
    {
        if (!$this->lesReparations->contains($lesReparation)) {
            $this->lesReparations[] = $lesReparation;
            $lesReparation->setNumeroChassis($this);
        }

        return $this;
    }

    public function removeLesReparation(Reparation $lesReparation): self
    {
        if ($this->lesReparations->contains($lesReparation)) {
            $this->lesReparations->removeElement($lesReparation);
            // set the owning side to null (unless already changed)
            if ($lesReparation->getNumeroChassis() === $this) {
                $lesReparation->setNumeroChassis(null);
            }
        }

        return $this;
    }
}
