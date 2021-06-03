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
     *
     * @ORM\Column(name="NUM", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
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

    // /**
    //  * @ORM\ManyToOne(targetEntity=Param::class, inversedBy="dossiers")
    //  * @ORM\JoinColumn(nullable=false, name="NUMSEQ", referencedColumnName="NUMSEQ")
    //  */
    // private $numseq;

    public function getNum(): ?int
    {
        return $this->num;
    }

    public function setNum($num)
    {
        $this->num = $num;
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
}
