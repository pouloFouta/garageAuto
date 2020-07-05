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
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeBon", inversedBy="bons")
     * @ORM\JoinColumn(nullable=false)
     */
    private $TypeBon;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="bons")
     */
    private $client;


    


    

    

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

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    
}
