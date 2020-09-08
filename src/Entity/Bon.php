<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BonRepository")
 */
class Bon
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    
    /**
     * @ORM\Column(type="date")
     */
    private $validite;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeBon", inversedBy="bons",cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $TypeBon;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="bons")
     */
    private $user;


    


    

    

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTypeBon(): ?TypeBon
    {
        return $this->TypeBon;
    }

    public function setTypeBon(?TypeBon $TypeBon): self
    {
        $this->TypeBon = $TypeBon;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    
}
