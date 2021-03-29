<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Panne
 *
 * @ORM\Table(name="panne", indexes={@ORM\Index(name="I_FK_PANNE_PIECE", columns={"PIECE"} )} )
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\PanneRepository")
 */
class Panne
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * @var string|null
     *
     * @ORM\Column(name="DESCRIPTION", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $description;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="DATE_PANNE", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $datePanne;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ETAT", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity=Piece::class, inversedBy="pannes")
     * @ORM\JoinColumn(nullable=false, name="PIECE", referencedColumnName="ID")
     */
    private $piece;

    /**
     * @ORM\OneToMany(targetEntity=Materiel::class, mappedBy="panne")
     */
    private $materiels;

    public function __construct()
    {
        $this->materiels = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDatePanne(): ?\DateTimeInterface
    {
        return $this->datePanne;
    }

    public function setDatePanne(?\DateTimeInterface $datePanne): self
    {
        $this->datePanne = $datePanne;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(?string $etat): self
    {
        $this->etat = $etat;

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

    /**
     * @return Collection|Materiel[]
     */
    public function getMateriels(): Collection
    {
        return $this->materiels;
    }

    public function addMateriel(Materiel $materiel): self
    {
        if (!$this->materiels->contains($materiel)) {
            $this->materiels[] = $materiel;
            $materiel->setPanne($this);
        }

        return $this;
    }

    public function removeMateriel(Materiel $materiel): self
    {
        if ($this->materiels->removeElement($materiel)) {
            // set the owning side to null (unless already changed)
            if ($materiel->getPanne() === $this) {
                $materiel->setPanne(null);
            }
        }

        return $this;
    }
}
