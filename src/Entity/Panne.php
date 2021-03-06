<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Boolean;
use PhpParser\Node\Expr\Cast\String_;

/**
 * Panne
 *
 * @ORM\Table(name="panne", indexes={@ORM\Index(name="I_FK_PANNE_PIECE", columns={"PIECE"} )}, indexes={@ORM\Index(name="I_FK_PANNE_MATERIEL", columns={"MATERIEL"} )} )
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
     * @ORM\Column(name="DESCRIPTION", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="DATE_PANNE", type="datetime", nullable=true)
     */
    private $datePanne;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ETAT", type="boolean", length=255, nullable=true)
     */
    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity=Piece::class, inversedBy="pannes")
     * @ORM\JoinColumn(nullable=false, name="PIECE", referencedColumnName="ID")
     */
    private $piece;

    /**
     * @ORM\ManyToOne(targetEntity=Materiel::class, inversedBy="pannes")
     * @ORM\JoinColumn(nullable=false, name="MATERIEL", referencedColumnName="ID")
     */
    private $materiel;

    private $nopiece;
    

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

    public function getEtat(): String 
    {
        return $this->etat;
    }

    public function setEtat(String $etat): self
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

    public function getMateriel(): ?Materiel
    {
        return $this->materiel;
    }

    public function setMateriel(?Materiel $materiel): self
    {
        $this->materiel = $materiel;

        return $this;
    }

    /**
     * Get the value of nopiece
     */ 
    public function getNopiece()
    {
        return $this->nopiece;
    }

    /**
     * Set the value of nopiece
     *
     * @return  self
     */ 
    public function setNopiece($nopiece)
    {
        $this->nopiece = $nopiece;

        return $this;
    }
}
