<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Piece
 *
 * @ORM\Table(name="piece")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\PieceRepository")
 */
class Piece
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="LIBELLE", type="string", length=255, nullable=true)
     */
    private $libelle;

    /**
     * @var int|null
     *
     * @ORM\Column(name="PRIX", type="bigint", nullable=true)
     */
    private $prix;

    /**
     * @ORM\OneToMany(targetEntity=Panne::class, mappedBy="piece")
     */
    private $pannes;

    /**
     * @ORM\Column(name="QUANTITE", type="bigint", nullable=true)
     */
    private $quantite;

    /**
     * @ORM\Column(name="ETAT",type="string", length=255)
     */
    private $etat;


    /**
     * @ORM\Column(name="CREATED_UP", type="datetime")
     */
    private $created_up;

    /**
     * @ORM\Column(name="UPDATED_UP",type="datetime", nullable=true)
     */
    private $updated_up;

    public function __construct()
    {
        $this->pannes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(?string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(?string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * @return Collection|Panne[]
     */
    public function getPannes(): Collection
    {
        return $this->pannes;
    }

    public function addPanne(Panne $panne): self
    {
        if (!$this->pannes->contains($panne)) {
            $this->pannes[] = $panne;
            $panne->setPiece($this);
        }

        return $this;
    }

    public function removePanne(Panne $panne): self
    {
        if ($this->pannes->removeElement($panne)) {
            // set the owning side to null (unless already changed)
            if ($panne->getPiece() === $this) {
                $panne->setPiece(null);
            }
        }

        return $this;
    }

    public function getQuantite(): ?string
    {
        return $this->quantite;
    }

    public function setQuantite(?string $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getCreatedUp(): ?\DateTimeInterface
    {
        return $this->created_up;
    }

    public function setCreatedUp(\DateTimeInterface $created_up): self
    {
        $this->created_up = $created_up;

        return $this;
    }

    public function getUpdatedUp(): ?\DateTimeInterface
    {
        return $this->updated_up;
    }

    public function setUpdatedUp(?\DateTimeInterface $updated_up): self
    {
        $this->updated_up = $updated_up;

        return $this;
    }


}
