<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReparateurReparationRepository")
 */
class ReparateurReparation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     */
    private $nb_jours_passes;


    /**
     * @ORM\ManyToOne(targetEntity="Reparateur", inversedBy="reparateurReparations")
     */

    private $reparateur;


    /**
     * @ORM\ManyToOne(targetEntity="Reparation", inversedBy="reparateurReparations")
     */

    private $reparation;

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

    public function getReparateur(): ?Reparateur
    {
        return $this->reparateur;
    }

    public function setReparateur(?Reparateur $reparateur): self
    {
        $this->reparateur = $reparateur;

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
}
