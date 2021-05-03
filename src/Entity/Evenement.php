<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evenement
 *
 * @ORM\Table(name="evenement", indexes={@ORM\Index(name="I_FK_EVENEMENT_DOSSIER", columns={"DOSSIER"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\EvenementRepository")
 */
class Evenement
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
     * @ORM\Column(name="DOSSIER", type="integer", nullable=false)
     */
    private $dossier;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="DATE_ECHANGE", type="datetime", nullable=true)
     */
    private $dateEchange;

    /**
     * @var string|null
     *
     * @ORM\Column(name="MOYEN", type="string", length=255, nullable=true)
     */
    private $moyen;

    /**
     * @var string|null
     *
     * @ORM\Column(name="DEMANDE", type="string", length=255, nullable=true)
     */
    private $demande;

    /**
     * @var string|null
     *
     * @ORM\Column(name="REPONSE_CLIENT", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $reponseClient = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="COMMENTAIRE", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $commentaire = 'NULL';

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getDossier(): ?int
    {
        return $this->dossier;
    }

    public function setDossier(int $dossier): self
    {
        $this->dossier = $dossier;

        return $this;
    }

    public function getDateEchange(): ?\DateTimeInterface
    {
        return $this->dateEchange;
    }

    public function setDateEchange(?\DateTimeInterface $dateEchange): self
    {
        $this->dateEchange = $dateEchange;

        return $this;
    }

    public function getMoyen(): ?string
    {
        return $this->moyen;
    }

    public function setMoyen(?string $moyen): self
    {
        $this->moyen = $moyen;

        return $this;
    }

    public function getDemande(): ?string
    {
        return $this->demande;
    }

    public function setDemande(?string $demande): self
    {
        $this->demande = $demande;

        return $this;
    }

    public function getReponseClient(): ?string
    {
        return $this->reponseClient;
    }

    public function setReponseClient(?string $reponseClient): self
    {
        $this->reponseClient = $reponseClient;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }


}
