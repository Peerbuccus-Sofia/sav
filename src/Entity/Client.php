<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Client
 *
 * @ORM\Table(name="client")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 */
class Client
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
     * @ORM\Column(name="NOM", type="string", length=255, nullable=true)
     * @Assert\Length(min=2, max=255) 
     * @Assert\NotBlank
     */
    private $nom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="PRENOM", type="string", length=255, nullable=true)
     * @Assert\Length(min=2, max=255)
     */
    private $prenom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ADR", type="string", length=255, nullable=true)
     * @Assert\Length(min=5, max=255)
     */
    private $adr;

    /**
     * @var string|null
     *
     * @ORM\Column(name="VILLE", type="string", length=255, nullable=true)
     * @Assert\Length(min=2, max=255) 
     */
    private $ville;

    /**
     * @var int
     *
     * @ORM\Column(name="CP", type="integer", nullable=true)
     * @Assert\Type(
     *   type="integer",
     *   message="La valeur {{ value }} ne corresponds pas à la valeur requise."
     * )
     * @Assert\Regex(pattern="/^\(0\)[0-4]*$/", message="CP requis") 
     */
    private $cp = NULL;

    /**
     * @var string|null
     *
     * @ORM\Column(name="TEL", type="string", length=32, nullable=true)
     * @Assert\NotBlank
     */
    private $tel;

    /**
     * @var string|null
     *
     * @ORM\Column(name="MAIL", type="string", length=255, nullable=true)
     *  @Assert\Email(
     *     message = "La valeur '{{ value }}' ne corresponds pas à une adresse email."
     * )
     */
    private $mail;

    /**
     * @ORM\OneToMany(targetEntity=Dossier::class, mappedBy="client")
     */
    private $dossiers;

    public function __construct()
    {
        $this->dossiers = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAdr(): ?string
    {
        return $this->adr;
    }

    public function setAdr(?string $adr): self
    {
        $this->adr = $adr;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCp(): ?int
    {
        return $this->cp;
    }

    public function setCp(?int $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(?string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(?string $mail): self
    {
        $this->mail = $mail;

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
            $dossier->setClient($this);
        }

        return $this;
    }

    public function removeDossier(Dossier $dossier): self
    {
        if ($this->dossiers->removeElement($dossier)) {
            // set the owning side to null (unless already changed)
            if ($dossier->getClient() === $this) {
                $dossier->setClient(null);
            }
        }

        return $this;
    }


}
