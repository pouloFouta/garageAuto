<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

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
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_entree;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_sortie;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $statut;


    /**
     * @ORM\OneToMany(targetEntity="BonReparation" ,mappedBy="reparation")
     */

    private $bon_reparations;


    /**
     * @ORM\ManyToOne(targetEntity="Facture" ,inversedBy="reparations")
     */

    private $facture;


    /**
     * @ORM\ManyToOne(targetEntity="Vehicule" ,inversedBy="lesReparations")
     */

    private $numeroChassis;


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

    private $reparateurReparations;


    /**
     * @ORM\ManyToMany(targetEntity="Panne" ,mappedBy="reparation")
     */


    private $pannes;

    public function __construct()
    {
        $this->bon_reparations = new ArrayCollection();
        $this->commandes = new ArrayCollection();
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

    /**
     * @return Collection|BonReparation[]
     */
    public function getBonReparations(): Collection
    {
        return $this->bon_reparations;
    }

    public function addBonReparation(BonReparation $bonReparation): self
    {
        if (!$this->bon_reparations->contains($bonReparation)) {
            $this->bon_reparations[] = $bonReparation;
            $bonReparation->setReparation($this);
        }

        return $this;
    }

    public function removeBonReparation(BonReparation $bonReparation): self
    {
        if ($this->bon_reparations->contains($bonReparation)) {
            $this->bon_reparations->removeElement($bonReparation);
            // set the owning side to null (unless already changed)
            if ($bonReparation->getReparation() === $this) {
                $bonReparation->setReparation(null);
            }
        }

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

    public function getNumeroChassis(): ?Vehicule
    {
        return $this->numeroChassis;
    }

    public function setNumeroChassis(?Vehicule $numeroChassis): self
    {
        $this->numeroChassis = $numeroChassis;

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
}
