<?php

namespace App\Entity;

//use App\Entity\Personne;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\PersonneRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="personneType", type="string")
 * @ORM\DiscriminatorMap({
 *   "Personne" = "Personne",
 *   "Responsable" = "Responsable",
 *   "Client" = "Client",
 *   "Reparateur" = "Reparateur",
 * })
 * 
 * @UniqueEntity(
 * fields ={"email"},
 * message = "un utilisateur est dejà inscrit avec cet email, merci de la modifier"
 * )
 * 
 */
 
class Personne  


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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Email(message="entrer une adresse mail valide")
     */
    private $email;

    

    /**
     * @ORM\Column(type="text",nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=20,nullable=true)
     
     */
    private $telephone;




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

 

}
