<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SpecialiteRepository")
 */
class Specialite
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
    private $nom_specialite;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Reparateur", mappedBy="specialite")
     */
    private $reparateurs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\GestionVehicule", mappedBy="specialite")
     */
    private $gestionVehicules;

    public function __construct()
    {
        $this->reparateurs = new ArrayCollection();
        $this->gestionVehicules = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomSpecialite(): ?string
    {
        return $this->nom_specialite;
    }

    public function setNomSpecialite(string $nom_specialite): self
    {
        $this->nom_specialite = $nom_specialite;

        return $this;
    }

    /**
     * @return Collection|Reparateur[]
     */
    public function getReparateurs(): Collection
    {
        return $this->reparateurs;
    }

    public function addReparateur(Reparateur $reparateur): self
    {
        if (!$this->reparateurs->contains($reparateur)) {
            $this->reparateurs[] = $reparateur;
            $reparateur->addSpecialite($this);
        }

        return $this;
    }

    public function removeReparateur(Reparateur $reparateur): self
    {
        if ($this->reparateurs->contains($reparateur)) {
            $this->reparateurs->removeElement($reparateur);
            $reparateur->removeSpecialite($this);
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
            $gestionVehicule->setSpecialite($this);
        }

        return $this;
    }

    public function removeGestionVehicule(GestionVehicule $gestionVehicule): self
    {
        if ($this->gestionVehicules->contains($gestionVehicule)) {
            $this->gestionVehicules->removeElement($gestionVehicule);
            // set the owning side to null (unless already changed)
            if ($gestionVehicule->getSpecialite() === $this) {
                $gestionVehicule->setSpecialite(null);
            }
        }

        return $this;
    }
}
