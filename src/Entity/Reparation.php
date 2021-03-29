<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reparation
 *
 * @ORM\Table(name="reparation", indexes={@ORM\Index(name="I_FK_REPARATION_MATERIEL", columns={"MATERIEL"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\ReparationRepository")
 */
class Reparation
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
     * @ORM\Column(name="ESTIMATION", type="bigint", nullable=true, options={"default"="NULL"})
     */
    private $estimation = 'NULL';

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

    public function getEstimation(): ?string
    {
        return $this->estimation;
    }

    public function setEstimation(?string $estimation): self
    {
        $this->estimation = $estimation;

        return $this;
    }


}
