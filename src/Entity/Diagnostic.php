<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Diagnostic
 *
 * @ORM\Table(name="diagnostic", indexes={@ORM\Index(name="I_FK_DIAGNOSTIC_MATERIEL", columns={"MATERIEL"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\DiagnosticRepository")
 */
class Diagnostic
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
     * @var int|null
     *
     * @ORM\Column(name="PRIX", type="bigint", nullable=true)
     */
    private $prix;

    /**
     * @ORM\Column(type="boolean", name="ETAT")
     */
    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity=Materiel::class, inversedBy="diagnostics")
     * @ORM\JoinColumn(nullable=false, name="MATERIEL", referencedColumnName="ID")
     */
    private $materiel;

    public function getId(): ?string
    {
        return $this->id;
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

    public function getEtat(): ?bool
    {
        return $this->etat;
    }

    public function setEtat(bool $etat): self
    {
        $this->etat = $etat;

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


}
