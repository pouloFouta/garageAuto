<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GestionVehiculeRepository")
 */
class GestionVehicule
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_jours_passes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Reparation", inversedBy="gestionVehicules")
     * @ORM\JoinColumn(nullable=false)
     */
    private $reparation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Specialite", inversedBy="gestionVehicules")
     * @ORM\JoinColumn(nullable=false)
     */
    private $specialite;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Reparateur", inversedBy="gestionVehicules")
     * @ORM\JoinColumn(nullable=false)
     */
    private $reparateur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbJoursPasses(): ?int
    {
        return $this->nb_jours_passes;
    }

    public function setNbJoursPasses(int $nb_jours_passes): self
    {
        $this->nb_jours_passes = $nb_jours_passes;

        return $this;
    }

    public function getReparation(): ?Reparation
    {
        return $this->reparation;
    }

    public function setReparation(?Reparation $reparation): self
    {
        $this->reparation = $reparation;

        return $this;
    }

    public function getSpecialite(): ?Specialite
    {
        return $this->specialite;
    }

    public function setSpecialite(?Specialite $specialite): self
    {
        $this->specialite = $specialite;

        return $this;
    }

    public function getReparateur(): ?Reparateur
    {
        return $this->reparateur;
    }

    public function setReparateur(?Reparateur $reparateur): self
    {
        $this->reparateur = $reparateur;

        return $this;
    }
}
