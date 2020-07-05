<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PanneRepository")
 */
class Panne
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
    private $motif;

    /**
     * @ORM\Column(type="date")
     */
    private $date_panne;

    /**
     * @ORM\Column(type="boolean")
     */
    private $est_resolu;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Reparation", inversedBy="pannes")
     */
    private $reparation;




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMotif(): ?string
    {
        return $this->motif;
    }

    public function setMotif(string $motif): self
    {
        $this->motif = $motif;

        return $this;
    }

    public function getDatePanne(): ?\DateTimeInterface
    {
        return $this->date_panne;
    }

    public function setDatePanne(\DateTimeInterface $date_panne): self
    {
        $this->date_panne = $date_panne;

        return $this;
    }

    public function getEstResolu(): ?bool
    {
        return $this->est_resolu;
    }

    public function setEstResolu(bool $est_resolu): self
    {
        $this->est_resolu = $est_resolu;

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
