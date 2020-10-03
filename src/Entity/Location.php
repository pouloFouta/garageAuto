<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Vehicule;
use phpDocumentor\Reflection\Types\Null_;
use phpDocumentor\Reflection\Types\Nullable;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LocationRepository")
 */
class Location
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     * @Assert\Type("\DateTimeInterface")
     */
    private $date_location;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     * @Assert\Type("\DateTimeInterface")
     */
    private $date_fin;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0,nullable =true)
     */
    private $prix;


    /**
     * @ORM\ManyToOne(targetEntity="Client" ,inversedBy="locations")
     * @ORM\JoinColumn(nullable=true)
     */

    private $client;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Vehicule", inversedBy="locations",cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     * 
     */
    private $vehicule;

    /**
     * @ORM\ManyToOne(targetEntity=MiseEnLocation::class, inversedBy="locationClient")
     */
    private $miseEnLocation;


    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateLocation(): ?\DateTimeInterface
    {
        return $this->date_location;
    }

    public function setDateLocation(\DateTimeInterface $date_location): self
    {
        $this->date_location = $date_location;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }


    public function setDateFin(\DateTimeInterface $date_fin): self
    {
        $this->date_fin = $date_fin;

        return $this;
    }


    public function getPrix()
    {
        return $this->prix;
    }

    public function setPrix($prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getClient(): ?User
    {
        return $this->client;
    }

    public function setClient(?User $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getVehicule(): ?Vehicule
    {
        return $this->vehicule;
    }

    public function setVehicule(?Vehicule $vehicule): self
    {
        $this->vehicule = $vehicule;

        return $this;
    }

    public function getMiseEnLocation(): ?MiseEnLocation
    {
        return $this->miseEnLocation;
    }

    public function setMiseEnLocation(?MiseEnLocation $miseEnLocation): self
    {
        $this->miseEnLocation = $miseEnLocation;

        return $this;
    }

    /**
     * 
     * cette fonction renseigne les jours possibles pour une location
     */
    public function verificationDatesLocations()
     {
        // dates impossibles pour la location
             $datesOccupes = $this->miseEnLocation->getDatesImpossibles();
             dump($datesOccupes);
            
             $formatJour = function($jour){

                return $jour->format('Y-m-d');

             };
            
        // comparaison des dates choisies avec les dates impossibles pour voir s'il ya pas de problème 

        $joursReserves= $this->getJours();

        $jours = array_map($formatJour, $joursReserves);

        

        //

      
          $joursImpossibles = array_map($formatJour, $datesOccupes);

       

            // on boucle sur les jours choisies du client et on vérifie si ces jours
            // font parties des jours impossibles pour une location
            foreach ($jours as $unjour)
            {
                if (array_search($unjour, $joursImpossibles) !== false) return false;
                
            }
             return true;
    }


    /**
     * 
     * cette fonction récupère les jours choisis par client pour une location
     * @return  array  un tableau DateTime 
     */

      public function getJours()
      {
           
            $resulat = range($this->date_location->getTimestamp(),
             $this->date_fin->getTimestamp(), 24 * 60 );
      
             $choix = array_map(function($unJour){

              return new \DateTime(date('Y-m-d', $unJour));


             } ,$resulat);

             return $choix;
       
}

/**
 * cette function retourne le nombre de jours entre 2 dates
 */

/*public function nbJours()

{
   $diff = $this->date_fin->diff($this->date_location);
   return $diff->days;

}*/

}
