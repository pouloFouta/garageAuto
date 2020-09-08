<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReparateurRepository")
 */
class Reparateur extends User
{
   

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Specialite", inversedBy="reparateurs")
     */
    private $specialite;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\GestionVehicule", mappedBy="reparateur")
     */
    private $gestionVehicules;



    

   
    public function __construct()
    {
        
        $this->specialite = new ArrayCollection();
        $this->gestionVehicules = new ArrayCollection();  
          
        
    
    }



    

    /**
     * @return Collection|Specialite[]
     */
    public function getSpecialite(): Collection
    {
        return $this->specialite;
    }

    public function addSpecialite(Specialite $specialite): self
    {
        if (!$this->specialite->contains($specialite)) {
            $this->specialite[] = $specialite;
        }

        return $this;
    }

    public function removeSpecialite(Specialite $specialite): self
    {
        if ($this->specialite->contains($specialite)) {
            $this->specialite->removeElement($specialite);
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
            $gestionVehicule->setReparateur($this);
        }

        return $this;
    }

    public function removeGestionVehicule(GestionVehicule $gestionVehicule): self
    {
        if ($this->gestionVehicules->contains($gestionVehicule)) {
            $this->gestionVehicules->removeElement($gestionVehicule);
            // set the owning side to null (unless already changed)
            if ($gestionVehicule->getReparateur() === $this) {
                $gestionVehicule->setReparateur(null);
            }
        }

        return $this;
    }

    
}
