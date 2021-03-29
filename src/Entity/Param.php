<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Param
 *
 * @ORM\Table(name="param")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\ParamRepository")
 */
class Param
{
    /**
     * @var int
     *
     * @ORM\Column(name="NUMSEQ", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $numseq;

    /**
     * @ORM\OneToMany(targetEntity=Dossier::class, mappedBy="numseq", orphanRemoval=true)
     */
    private $dossiers;

    public function __construct()
    {
        $this->dossiers = new ArrayCollection();
    }

    public function getNumseq(): ?string
    {
        return $this->numseq;
    }

    /**
     * @return Collection|Dossier[]
     */
    public function getDossiers(): Collection
    {
        return $this->dossiers;
    }

    public function addDossier(Dossier $dossier): self
    {
        if (!$this->dossiers->contains($dossier)) {
            $this->dossiers[] = $dossier;
            $dossier->setNumseq($this);
        }

        return $this;
    }

    public function removeDossier(Dossier $dossier): self
    {
        if ($this->dossiers->removeElement($dossier)) {
            // set the owning side to null (unless already changed)
            if ($dossier->getNumseq() === $this) {
                $dossier->setNumseq(null);
            }
        }

        return $this;
    }


}
