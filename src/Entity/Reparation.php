<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReparationRepository")
 */
class Reparation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank (message=" vous devez indiquer ce champ")
     */
    private $description;

    /**
     * @ORM\Column(type="datetime" )
     */
    private $date_entree;

    /**
     * @ORM\Column(type="datetime", nullable=true )
     * @Assert\GreaterThanOrEqual("today")
     */
    private $date_sortie;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $statut;


   

    /**
     * @ORM\ManyToOne(targetEntity="Facture" ,inversedBy="reparations")
     */

    private $facture;


   
    /**
     * @ORM\OneToMany(targetEntity="Commande" ,mappedBy="reparation")
     */

    private $commandes;





    /**
     * @ORM\ManyToOne(targetEntity="Fournisseur" ,inversedBy="commandes")
     */

    private $fournisseur;


    /**
     * @ORM\OneToMany(targetEntity="ReparateurReparation" ,mappedBy="reparation")
     */

     // private $reparateur;

    /** 
    * @ORM\ManyToOne(targetEntity="App\Entity\Vehicule", inversedBy="reparations")
    * @ORM\JoinColumn(nullable=false)
    * @ORM\JoinColumn(onDelete="CASCADE")
    * @Assert\Valid

    */
   private $vehicule;


   
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Panne", mappedBy="reparation")
     *
     */
    private $pannes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\GestionVehicule", mappedBy="reparation")
     */
    private $gestionVehicules;

    public function __construct()
    {
       
        $this->commandes = new ArrayCollection();
        $this->reparateurReparations = new ArrayCollection();
        $this->pannes = new ArrayCollection();
        $this->gestionVehicules = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDateEntree(): ?\DateTimeInterface
    {
        return $this->date_entree;
    }

    public function setDateEntree(\DateTimeInterface $date_entree): self
    {
        $this->date_entree = $date_entree;

        return $this;
    }

    public function getDateSortie(): ?\DateTimeInterface
    {
        return $this->date_sortie;
    }

    public function setDateSortie(\DateTimeInterface $date_sortie): self
    {
        $this->date_sortie = $date_sortie;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    

    public function getFacture(): ?Facture
    {
        return $this->facture;
    }

    public function setFacture(?Facture $facture): self
    {
        $this->facture = $facture;

        return $this;
    }

   

    /**
     * @return Collection|Commande[]
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setReparation($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->contains($commande)) {
            $this->commandes->removeElement($commande);
            // set the owning side to null (unless already changed)
            if ($commande->getReparation() === $this) {
                $commande->setReparation(null);
            }
        }

        return $this;
    }

    public function getFournisseur(): ?Fournisseur
    {
        return $this->fournisseur;
    }

    public function setFournisseur(?Fournisseur $fournisseur): self
    {
        $this->fournisseur = $fournisseur;

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

    /**
     * @return Collection|Panne[]
     */
    public function getPannes(): Collection
    {
        return $this->pannes;
    }

    public function addPanne(Panne $panne): self
    {
        if (!$this->pannes->contains($panne)) {
            $this->pannes[] = $panne;
            $panne->setReparation($this);
        }

        return $this;
    }

    public function removePanne(Panne $panne): self
    {
        if ($this->pannes->contains($panne)) {
            $this->pannes->removeElement($panne);
            // set the owning side to null (unless already changed)
            if ($panne->getReparation() === $this) {
                $panne->setReparation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|GestionVehicule[]
     */
    public function getGestionVehicules(): Collection
    {
        return $this->gestionVehicules;
    }

    public function addGestionVehicule(GestionVehicule $gestionVehicule): self
    {
        if (!$this->gestionVehicules->contains($gestionVehicule)) {
            $this->gestionVehicules[] = $gestionVehicule;
            $gestionVehicule->setReparation($this);
        }

        return $this;
    }

    public function removeGestionVehicule(GestionVehicule $gestionVehicule): self
    {
        if ($this->gestionVehicules->contains($gestionVehicule)) {
            $this->gestionVehicules->removeElement($gestionVehicule);
            // set the owning side to null (unless already changed)
            if ($gestionVehicule->getReparation() === $this) {
                $gestionVehicule->setReparation(null);
            }
        }

        return $this;
    }
}
