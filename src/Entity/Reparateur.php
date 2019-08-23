<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReparateurRepository")
 */
class Reparateur extends Personne
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
    private $specialite;

    /**
     * @ORM\OneToMany(targetEntity="ReparateurReparation", mappedBy="reparateur")
     */


    private $reparateurReparations;


    public function __construct()
    {
        $this->reparateurReparations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSpecialite(): ?string
    {
        return $this->specialite;
    }

    public function setSpecialite(string $specialite): self
    {
        $this->specialite = $specialite;

        return $this;
    }

    /**
     * @return Collection|ReparateurReparation[]
     */
    public function getReparateurReparations(): Collection
    {
        return $this->reparateurReparations;
    }

    public function addReparateurReparation(ReparateurReparation $reparateurReparation): self
    {
        if (!$this->reparateurReparations->contains($reparateurReparation)) {
            $this->reparateurReparations[] = $reparateurReparation;
            $reparateurReparation->setReparateur($this);
        }

        return $this;
    }

    public function removeReparateurReparation(ReparateurReparation $reparateurReparation): self
    {
        if ($this->reparateurReparations->contains($reparateurReparation)) {
            $this->reparateurReparations->removeElement($reparateurReparation);
            // set the owning side to null (unless already changed)
            if ($reparateurReparation->getReparateur() === $this) {
                $reparateurReparation->setReparateur(null);
            }
        }

        return $this;
    }
}
