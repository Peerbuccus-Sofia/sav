<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Intervenir
 *
 * @ORM\Table(name="intervenir", indexes={@ORM\Index(name="I_FK_INTERVENIR_DOSSIER", columns={"DOSSIER"}), @ORM\Index(name="I_FK_INTERVENIR_TECHNICIEN", columns={"TECHNICIEN"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\IntervenirRepository")
 */
class Intervenir
{
    /**
     * @var int
     *
     * @ORM\Column(name="TECHNICIEN", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $technicien;

    /**
     * @var int
     *
     * @ORM\Column(name="DOSSIER", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $dossier;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="DATE_INTERVENTION", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $dateIntervention = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="DESCRIPTION", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $description = 'NULL';

    public function getTechnicien(): ?string
    {
        return $this->technicien;
    }

    public function getDossier(): ?string
    {
        return $this->dossier;
    }

    public function getDateIntervention(): ?\DateTimeInterface
    {
        return $this->dateIntervention;
    }

    public function setDateIntervention(?\DateTimeInterface $dateIntervention): self
    {
        $this->dateIntervention = $dateIntervention;

        return $this;
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


}
