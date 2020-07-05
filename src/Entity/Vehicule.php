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
     * @ORM\ManyToOne(targetEntity="Client" ,inversedBy="vehicules", cascade={"persist"})
     */

    private $client;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Location", mappedBy="vehicule")
     */
    private $locations;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Achat", mappedBy="vehicule", cascade={"persist", "remove"})
     */
    private $achat;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reparation", mappedBy="vehicule", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $reparations;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbPortes;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $transmission;

    /**
     * @ORM\Column(type="text")
     */
    private $options;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $modele;

   

    public function __construct()
    {
        
        $this->locations = new ArrayCollection();
        $this->reparations = new ArrayCollection();
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
     * @return Collection|Location[]
     */
    public function getLocations(): Collection
    {
        return $this->locations;
    }

    public function addLocation(Location $location): self
    {
        if (!$this->locations->contains($location)) {
            $this->locations[] = $location;
            $location->setVehicule($this);
        }

        return $this;
    }

    public function removeLocation(Location $location): self
    {
        if ($this->locations->contains($location)) {
            $this->locations->removeElement($location);
            // set the owning side to null (unless already changed)
            if ($location->getVehicule() === $this) {
                $location->setVehicule(null);
            }
        }

        return $this;
    }

    public function getAchat(): ?Achat
    {
        return $this->achat;
    }

    public function setAchat(Achat $achat): self
    {
        $this->achat = $achat;

        // set the owning side of the relation if necessary
        if ($achat->getVehicule() !== $this) {
            $achat->setVehicule($this);
        }

        return $this;
    }

    /**
     * @return Collection|Reparation[]
     */
    public function getReparations(): Collection
    {
        return $this->reparations;
    }

    public function addReparation(Reparation $reparation): self
    {
        if (!$this->reparations->contains($reparation)) {
            $this->reparations[] = $reparation;
            $reparation->setVehicule($this);
        }

        return $this;
    }

    public function removeReparation(Reparation $reparation): self
    {
        if ($this->reparations->contains($reparation)) {
            $this->reparations->removeElement($reparation);
            // set the owning side to null (unless already changed)
            if ($reparation->getVehicule() === $this) {
                $reparation->setVehicule(null);
            }
        }

        return $this;
    }

    public function getNbPortes(): ?int
    {
        return $this->nbPortes;
    }

    public function setNbPortes(int $nbPortes): self
    {
        $this->nbPortes = $nbPortes;

        return $this;
    }

    public function getTransmission(): ?string
    {
        return $this->transmission;
    }

    public function setTransmission(string $transmission): self
    {
        $this->transmission = $transmission;

        return $this;
    }

    public function getOptions(): ?string
    {
        return $this->options;
    }

    public function setOptions(string $options): self
    {
        $this->options = $options;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }
}
