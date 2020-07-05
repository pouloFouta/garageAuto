<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeBonRepository")
 */
class TypeBon
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
    private $description_type;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_points_necessaires;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Bon", mappedBy="TypeBon")
     */
    private $bons;

    public function __construct()
    {
        $this->bons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescriptionType(): ?string
    {
        return $this->description_type;
    }

    public function setDescriptionType(string $description_type): self
    {
        $this->description_type = $description_type;

        return $this;
    }

    public function getNbPointsNecessaires(): ?int
    {
        return $this->nb_points_necessaires;
    }

    public function setNbPointsNecessaires(int $nb_points_necessaires): self
    {
        $this->nb_points_necessaires = $nb_points_necessaires;

        return $this;
    }

    /**
     * @return Collection|Bon[]
     */
    public function getBons(): Collection
    {
        return $this->bons;
    }

    public function addBon(Bon $bon): self
    {
        if (!$this->bons->contains($bon)) {
            $this->bons[] = $bon;
            $bon->setTypeBon($this);
        }

        return $this;
    }

    public function removeBon(Bon $bon): self
    {
        if ($this->bons->contains($bon)) {
            $this->bons->removeElement($bon);
            // set the owning side to null (unless already changed)
            if ($bon->getTypeBon() === $this) {
                $bon->setTypeBon(null);
            }
        }

        return $this;
    }
}
