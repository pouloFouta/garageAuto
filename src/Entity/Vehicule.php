<?php

namespace App\Entity;

use App\Entity\Vente;
use DateTimeInterface;
use App\Entity\ImageVehicule;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass="App\Repository\VehiculeRepository")
 * @ORM\Entity
 * @UniqueEntity("numero_chassis")
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
     * @ORM\Column(type="string", length = 17)
     * 
     */
   
    private $numero_chassis;
      
    /**
     * @ORM\Column(type="string", length=9,nullable=true)
     * 
     * 
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
     * @ORM\Column(type="integer",nullable=true)
     * @Assert\Range(min=0,
     * max=600000,
     * minMessage="le nombre de km  doit être d'au moins 0",
     * maxMessage ="le nombre de km ne doit pas dépasser 600000")
     * @Assert\LessThanOrEqual(propertyPath="kilometrage_actuel", message="le kilométrage achat doit être inférieur ou égal au kilométrage actuel")
     */
    private $kilometrage_achat;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(min=0,
     * max=600000,
     * minMessage="le nombre de km  doit être d'au moins 0",
     * maxMessage ="le nombre de km ne doit pas dépasser 600000")
     * @Assert\GreaterThanOrEqual(propertyPath="kilometrage_achat",message="le kilométrage actuel doit être supérieur ou égal au kilométrage achat")
     * 
     */
    private $kilometrage_actuel;


    /**
     * @ORM\ManyToOne(targetEntity="User" ,inversedBy="vehicules", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     * @Assert\Valid
     */

    private $user;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Location", mappedBy="vehicule",cascade={"persist", "remove"})
     */
    private $locations;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Vente", mappedBy="vehicule", cascade={"persist", "remove"})
     */
    private $vente;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reparation", mappedBy="vehicule")
     * @ORM\JoinColumn(nullable=false)
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

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(min=30,
     * max=400,
     * minMessage="le nombre de chevaux doit être une valeur positive et d'au moins 30 cv",
     * maxMessage ="le nombre de chevaux doit être une valeur positive  et ne doit pas dépasser 400 cv"
     * )
     */

    private $puissance;

    /**
     * @ORM\Column(type="date")
     */
    private $anneeFabrication;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageVehicule;

    
   

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?Client $user): self
    {
        $this->user = $user;

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

    public function getVente(): ?Vente
    {
        return $this->vente;
    }

    public function setVente(Vente $vente): self
    {
        $this->vente = $vente;

        // set the owning side of the relation if necessary
        if ($vente->getVehicule() !== $this) {
            $vente->setVehicule($this);
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


    
    public function getPuissance(): ?int
    {
        return $this->puissance;
    }

    public function setPuissance(int $puissance): self
    {
        $this->puissance = $puissance;

        return $this;
    }

    public function getAnneeFabrication(): ?\DateTimeInterface
    {
        return $this->anneeFabrication;
    }

    public function setAnneeFabrication(\DateTimeInterface $anneeFabrication): self
    {
        $this->anneeFabrication = $anneeFabrication;

        return $this;
    }

    public function getImageVehicule(): ?string
    {
        return $this->imageVehicule;
    }

    public function setImageVehicule(?string $imageVehicule): self
    {
        $this->imageVehicule = $imageVehicule;

        return $this;
    }

}
