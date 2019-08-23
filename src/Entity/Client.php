<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 */
class Client extends Personne
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\ManyToOne(targetEntity="Groupe" ,inversedBy="clients")
     */

    private $groupe;



    /**
     * @ORM\OneToMany(targetEntity="Vehicule" ,mappedBy="client")
     */

    private  $vehicules;

    /**
     * @ORM\OneToMany(targetEntity="Location" ,mappedBy="client")
     */

    private $locations;

    /**
     * @ORM\OneToMany(targetEntity="Achat" ,mappedBy="client")
     */

    private $achats;


    /**
     * @ORM\ManyToMany(targetEntity="BonReparation" ,inversedBy="bons")
     * @ORM\JoinTable(name="clients_bons")
     */

    private $bons;





    public function __construct()
    {
        $this->vehicules = new ArrayCollection();
        $this->locations = new ArrayCollection();
        $this->achats = new ArrayCollection();
        $this->bons = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGroupe(): ?Groupe
    {
        return $this->groupe;
    }

    public function setGroupe(?Groupe $groupe): self
    {
        $this->groupe = $groupe;

        return $this;
    }

    /**
     * @return Collection|Vehicule[]
     */
    public function getVehicules(): Collection
    {
        return $this->vehicules;
    }

    public function addVehicule(Vehicule $vehicule): self
    {
        if (!$this->vehicules->contains($vehicule)) {
            $this->vehicules[] = $vehicule;
            $vehicule->setClient($this);
        }

        return $this;
    }

    public function removeVehicule(Vehicule $vehicule): self
    {
        if ($this->vehicules->contains($vehicule)) {
            $this->vehicules->removeElement($vehicule);
            // set the owning side to null (unless already changed)
            if ($vehicule->getClient() === $this) {
                $vehicule->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Location[]
     */
    public function getLocations(): Collection
    {
        return $this->locations;
    }

    public function addLocation(Location $location): self
    {
        if (!$this->locations->contains($location)) {
            $this->locations[] = $location;
            $location->setClient($this);
        }

        return $this;
    }

    public function removeLocation(Location $location): self
    {
        if ($this->locations->contains($location)) {
            $this->locations->removeElement($location);
            // set the owning side to null (unless already changed)
            if ($location->getClient() === $this) {
                $location->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Achat[]
     */
    public function getAchats(): Collection
    {
        return $this->achats;
    }

    public function addAchat(Achat $achat): self
    {
        if (!$this->achats->contains($achat)) {
            $this->achats[] = $achat;
            $achat->setClient($this);
        }

        return $this;
    }

    public function removeAchat(Achat $achat): self
    {
        if ($this->achats->contains($achat)) {
            $this->achats->removeElement($achat);
            // set the owning side to null (unless already changed)
            if ($achat->getClient() === $this) {
                $achat->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|BonReparation[]
     */
    public function getBons(): Collection
    {
        return $this->bons;
    }

    public function addBon(BonReparation $bon): self
    {
        if (!$this->bons->contains($bon)) {
            $this->bons[] = $bon;
        }

        return $this;
    }

    public function removeBon(BonReparation $bon): self
    {
        if ($this->bons->contains($bon)) {
            $this->bons->removeElement($bon);
        }

        return $this;
    }
}
