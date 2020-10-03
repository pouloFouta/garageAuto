<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FactureRepository")
 */
class Facture
{
    /**
     * @ORM\Id()
     * 
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_facture;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    private $tva;

    

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2, nullable=true)
     */
    private $montant;

     

    /**
     * @ORM\ManyToOne(targetEntity="Responsable" ,inversedBy="factures")
     */

    private $responsable;

    /**
     * @ORM\OneToMany(targetEntity="Reparation" ,mappedBy="facture")
     */

    private $reparations;

     
    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="factures")
     */
    private $client;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message ="veuillez indiquer le libéllé de la facture")
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $est_paye;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    private $montantHorsTva;


    public function __construct()
    {
        $this->reparations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateFacture(): ?\DateTimeInterface
    {
        return $this->date_facture;
    }

    public function setDateFacture(\DateTimeInterface $date_facture): self
    {
        $this->date_facture = $date_facture;

        return $this;
    }

    public function getTva()
    {
        return $this->tva;
    }

    public function setTva($tva): self
    {
        $this->tva = $tva;

        return $this;
    }

    public function getMontant()
    {
        return $this->montant;
    }

    public function setMontant($montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getResponsable(): ?Responsable
    {
        return $this->responsable;
    }

    public function setResponsable(?Responsable $responsable): self
    {
        $this->responsable = $responsable;

        return $this;
    }

    /**
     * @return Collection|Reparation[]
     */
    public function getReparations(): Collection
    {
        return $this->reparations;
    }

    public function addReparation(Reparation $reparation): self
    {
        if (!$this->reparations->contains($reparation)) {
            $this->reparations[] = $reparation;
            $reparation->setFacture($this);
        }

        return $this;
    }

    public function removeReparation(Reparation $reparation): self
    {
        if ($this->reparations->contains($reparation)) {
            $this->reparations->removeElement($reparation);
            // set the owning side to null (unless already changed)
            if ($reparation->getFacture() === $this) {
                $reparation->setFacture(null);
            }
        }

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

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getEstPaye(): ?string
    {
        return $this->est_paye;
    }

    public function setEstPaye(?string $est_paye): self
    {
        $this->est_paye = $est_paye;

        return $this;
    }

    public function getMontantHorsTva(): ?string
    {
        return $this->montantHorsTva;
    }

    public function setMontantHorsTva(string $montantHorsTva): self
    {
        $this->montantHorsTva = $montantHorsTva;

        return $this;
    }
}
