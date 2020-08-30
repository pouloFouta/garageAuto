<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

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
     * 
     */
    private $description_type;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Positive
     * 
     */
    private $nb_points_necessaires;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Bon", mappedBy="TypeBon",cascade={"persist", "remove"})
     */
    private $bons;

    /**
     * @ORM\Column(type="date")
     */
    private $validite;

    /**
     * ce champ sert à générer le nombre de  bons clients pour ce type de bon
     * @ORM\Column(type="integer", nullable=true)
     */
    private $quantite;

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

    public function getValidite(): ?\DateTimeInterface
    {
        return $this->validite;
    }

    public function setValidite(\DateTimeInterface $validite): self
    {
        $this->validite = $validite;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(?int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }
}
