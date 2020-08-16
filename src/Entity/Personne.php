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
/*Personne implements UserInterface 
implementer les methodes associes 



*/


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
     * @ORM\Column(type="text")
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=20)
     
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

  // a partir d'ici les modifications pour transformer Personne en User pour l'authentfication
    /*public function getUsername()
    {
        return $this->email;
    }

    private $personneRoles;

    public function __construct()
    {
        $this->personneRoles = new ArrayCollection();
    }

    public function getRoles()
    {
        

        $roles =$this->personneRoles->map(function($role) {

           return $role->getTitle();
        })->toArray();

        $roles [] = 'ROLE_USER';

       

        
        return $roles;
    }
   
    public function getPassword()

    {
        return $this->mot_de_passe; 
    }

    public function getSalt() {}

   
    public function eraseCredentials(){}

    public function getMotDePasse(): ?string
    {
        return $this->mot_de_passe;
    }

    public function setMotDePasse(string $mot_de_passe): self
    {
        $this->mot_de_passe = $mot_de_passe;

        return $this;
    }
    
    public function getFullName(){

        return "{$this->prenom} {$this->nom}";

    }

    /**
     * @return Collection|Role[]
     */
    
    /* public function getPersonneRoles(): Collection
    {
        return $this->personneRoles;
    }

    public function addPersonneRole(Role $personneRole): self
    {
        if (!$this->personneRoles->contains($personneRole)) {
            $this->personneRoles[] = $personneRole;
            $personneRole->addUser($this);
        }

        return $this;
    }

    public function removePersonneRole(Role $personneRole): self
    {
        if ($this->personneRoles->contains($personneRole)) {
            $this->personneRoles->removeElement($personneRole);
            $personneRole->removeUser($this);
        }

        return $this;
    }
    /**
     * 
     * @Assert\EqualTo(propertyPath="mot_de_passe", message="Vous n'avez pas correctement confirmé le mot de passe!")
     */
    
    
    // public $confirmation_mot_de_passe;



}
