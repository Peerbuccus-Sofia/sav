<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dossier
 *
 * @ORM\Table(name="dossier", indexes={
 * @ORM\Index(name="I_FK_DOSSIER_PAIEMENT", columns={"PAIEMENT"}),
 * @ORM\Index(name="I_FK_DOSSIER_MATERIEL", columns={"MATERIEL"}),   
 * @ORM\Index(name="I_FK_DOSSIER_CLIENT", columns={"CLIENT"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\DossierRepository")
 */
class Dossier
{

    /**
     * @var int
     * @ORM\Column(name="ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     *
     * @ORM\Column(name="NUM", type="string", length=32, nullable=false)
     */
    private $num;

    /**
     * @var string|null
     *
     * @ORM\Column(name="STATUT", type="string", length=255, nullable=true)
     */
    private $statut;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="DATE_DOSSIER", type="datetime", nullable=true)
     */
    private $dateDossier;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ESTIMATION", type="bigint", nullable=true, options={"default"="NULL"})
     */
    private $estimation;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ACOMPTE", type="bigint", nullable=true, options={"default"="NULL"})
     */
    private $acompte;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="dossiers")
     * @ORM\JoinColumn(nullable=false, name="CLIENT", referencedColumnName="ID")
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity=Materiel::class, inversedBy="dossiers")
     * @ORM\JoinColumn(nullable=false, name="MATERIEL", referencedColumnName="ID")
     */
    private $materiel;

    /**
     * @ORM\ManyToOne(targetEntity=Paiement::class, inversedBy="dossiers")
     * @ORM\JoinColumn(nullable=false, name="PAIEMENT", referencedColumnName="ID")
     */
    private $paiement;

    /**
     * @ORM\ManyToOne(targetEntity=Employe::class, inversedBy="dossiers")
     * @ORM\JoinColumn(nullable=false, name="EMPLOYE", referencedColumnName="id")
     */
    private $employe;

    /**
     * @ORM\Column(name="TYPE", type="string", length=255)
     */
    private $type;

   

    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNum(): ?string
    {
        return $this->num;
    }

    public function setNum($num) : self
    {
        $this->num = $num;
        return $this;
    }


    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(?string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getDateDossier(): ?\DateTimeInterface
    {
        return $this->dateDossier;
    }

    public function setDateDossier(?\DateTimeInterface $dateDossier): self
    {
        $this->dateDossier = $dateDossier;

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

    public function getAcompte(): ?string
    {
        return $this->acompte;
    }

    public function setAcompte(?string $acompte): self
    {
        $this->acompte = $acompte;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

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

    public function getPaiement(): ?Paiement
    {
        return $this->paiement;
    }

    public function setPaiement(?Paiement $paiement): self
    {
        $this->paiement = $paiement;

        return $this;
    }

    public function getEmploye(): ?Employe
    {
        return $this->employe;
    }

    public function setEmploye(?Employe $employe): self
    {
        $this->employe = $employe;

        return $this;
    }

    public function getReparation(): ?bool
    {
        return $this->reparation;
    }

    public function setReparation(bool $reparation): self
    {
        $this->reparation = $reparation;

        return $this;
    }

    public function getDiagnostic(): ?bool
    {
        return $this->diagnostic;
    }

    public function setDiagnostic(bool $diagnostic): self
    {
        $this->diagnostic = $diagnostic;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }


    
}
