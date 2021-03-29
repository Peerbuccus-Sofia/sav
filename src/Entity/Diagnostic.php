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
     * @var int
     *
     * @ORM\Column(name="MATERIEL", type="integer", nullable=false)
     */
    private $materiel;

    /**
     * @var int|null
     *
     * @ORM\Column(name="PRIX", type="bigint", nullable=true, options={"default"="NULL"})
     */
    private $prix = 'NULL';

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getMateriel(): ?int
    {
        return $this->materiel;
    }

    public function setMateriel(int $materiel): self
    {
        $this->materiel = $materiel;

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


}
