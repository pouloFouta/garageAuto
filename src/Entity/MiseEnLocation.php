<?php

namespace App\Entity;

use App\Repository\MiseEnLocationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MiseEnLocationRepository::class)
 */
class MiseEnLocation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $prixParJour;

    /**
     * @ORM\OneToOne(targetEntity=Vehicule::class, inversedBy="miseEnLocation", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $vehicule;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $statutMise;

    /**
     * @ORM\OneToMany(targetEntity=Location::class, mappedBy="miseEnLocation")
     */
    private $locationClient;

    public function __construct()
    {
        $this->locationClient = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrixParJour(): ?int
    {
        return $this->prixParJour;
    }

    public function setPrixParJour(int $prixParJour): self
    {
        $this->prixParJour = $prixParJour;

        return $this;
    }

    public function getVehicule(): ?Vehicule
    {
        return $this->vehicule;
    }

    public function setVehicule(Vehicule $vehicule): self
    {
        $this->vehicule = $vehicule;

        return $this;
    }

    public function getStatutMise(): ?string
    {
        return $this->statutMise;
    }

    public function setStatutMise(string $statutMise): self
    {
        $this->statutMise = $statutMise;

        return $this;
    }

    /**
     * @return Collection|Location[]
     */
    public function getLocationClient(): Collection
    {
        return $this->locationClient;
    }

    public function addLocationClient(Location $locationClient): self
    {
        if (!$this->locationClient->contains($locationClient)) {
            $this->locationClient[] = $locationClient;
            $locationClient->setMiseEnLocation($this);
        }

        return $this;
    }

    public function removeLocationClient(Location $locationClient): self
    {
        if ($this->locationClient->contains($locationClient)) {
            $this->locationClient->removeElement($locationClient);
            // set the owning side to null (unless already changed)
            if ($locationClient->getMiseEnLocation() === $this) {
                $locationClient->setMiseEnLocation(null);
            }
        }

        return $this;
    }

/**
 * 
 * cette fonction permet de retourner un tableau des jours de locations non disponibles pour
 * une mise en location 
 * 
 * @return array un tableau d'objets DateTime donnant les jours d'occupation d'un véhicule
 */

 public function getDatesImpossibles()

{
      $datesOccupes =[];

      foreach($this->locationClient as $location)
      {
          // calculer les jours qui se situent entre le début et la fin de la location du client
            $joursOccupes = range($location->getDateLocation()->getTimestamp(),
            $location->getDateFin()->getTimestamp(),
            24 * 60  );

            // tranformation de $joursOccupes qui est en timestamp en format date grâce à la function array_map

            $jours = array_map(function($dayTimestamp)
              {
                return new \DateTime(date('Y-m-d', $dayTimestamp)); 
                   
               }, $joursOccupes);

            // fusion des tableaux pour avoir toutes dates occupées dans la variable $datesOccupes
               $datesOccupes= array_merge($datesOccupes,$jours);
             
      }
      return $datesOccupes;
}


}