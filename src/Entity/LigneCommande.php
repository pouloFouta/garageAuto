<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LigneCommandeRepository")
 */
class LigneCommande
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     */
    private $quantite;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $prix_unitaire;


    /**
     * @ORM\ManyToOne(targetEntity="Commande", inversedBy="ligneCommandes")
     */

    private $commande;


    /**
     * @ORM\ManyToOne(targetEntity="Piece", inversedBy="ligneCommandes")
     */

    private $piece;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getPrixUnitaire()
    {
        return $this->prix_unitaire;
    }

    public function setPrixUnitaire($prix_unitaire): self
    {
        $this->prix_unitaire = $prix_unitaire;

        return $this;
    }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): self
    {
        $this->commande = $commande;

        return $this;
    }

    public function getPiece(): ?Piece
    {
        return $this->piece;
    }

    public function setPiece(?Piece $piece): self
    {
        $this->piece = $piece;

        return $this;
    }
}
