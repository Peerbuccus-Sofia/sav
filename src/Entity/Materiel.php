<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

// *, indexes={@ORM\Index(name="I_FK_MATERIEL_PANNE", columns={"PANNE"})}


/**
 * Materiel
 * @ORM\Table(name="materiel")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\MaterielRepository")
 */
class Materiel
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
     * @ORM\Column(name="TYPE", type="string", length=255, nullable=true)
     * @Assert\NotBlank
     */
    private $type;

    /**
     * @var string|null
     *
     * @ORM\Column(name="MARQUE", type="string", length=255, nullable=true)
     * @Assert\NotBlank
     * 
     */
    private $marque;

    /**
     * @var string|null
     *
     * @ORM\Column(name="MODEL", type="string", length=255, nullable=true)
     * @Assert\NotBlank
     * 
     */
    private $model;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ETAT", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $etat;

    /**
     * @var string|null
     *
     * @ORM\Column(name="COMPTE", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $compte;

    /**
     * @var string|null
     *
     * @ORM\Column(name="MDP", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $mdp;

    /**
     * @ORM\OneToMany(targetEntity=Dossier::class, mappedBy="materiel")
     */
    private $dossiers;

    /**
     * @ORM\OneToMany(targetEntity=Panne::class, mappedBy="materiel")
     */
    private $pannes;


    public function __construct()
    {
        $this->dossiers = new ArrayCollection();
        $this->pannes = new ArrayCollection();
      
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(?string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(?string $model): self
    {
        $this->model = $model;

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

    public function getCompte(): ?string
    {
        return $this->compte;
    }

    public function setCompte(?string $compte): self
    {
        $this->compte = $compte;

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(?string $mdp): self
    {
        $this->mdp = $mdp;

        return $this;
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
            $dossier->setMateriel($this);
        }

        return $this;
    }

    public function removeDossier(Dossier $dossier): self
    {
        if ($this->dossiers->removeElement($dossier)) {
            // set the owning side to null (unless already changed)
            if ($dossier->getMateriel() === $this) {
                $dossier->setMateriel(null);
            }
        }

        return $this;
    }

    public function getPanne(): ?Panne
    {
        return $this->panne;
    }

    public function setPanne(?Panne $panne): self
    {
        $this->panne = $panne;

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
            $panne->setMateriel($this);
        }

        return $this;
    }

    public function removePanne(Panne $panne): self
    {
        if ($this->pannes->removeElement($panne)) {
            // set the owning side to null (unless already changed)
            if ($panne->getMateriel() === $this) {
                $panne->setMateriel(null);
            }
        }

        return $this;
    }

}
