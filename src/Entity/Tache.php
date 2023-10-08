<?php

namespace App\Entity;

use App\Repository\TacheRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TacheRepository::class)]
class Tache
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(type: "text", length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 100)]
    private ?string $statut = null;

    #[ORM\Column(length: 100)]
    private ?string $complexite = null;

    #[ORM\Column(length: 100)]
    private ?string $priorite = null;

    #[ORM\Column]
    private ?bool $est_recurrente = false;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_debut = null;

    #[ORM\Column(length: 255)]
    private ?string $mot_cles = null;

    #[ORM\Column(length: 255)]
    private ?string $referance = null;

    #[ORM\Column(length: 255)]
    private ?string $referanciel = null;

    #[ORM\Column(length: 255)]
    private ?string $role = null;

    #[ORM\OneToOne(mappedBy: 'tache', cascade: ['persist', 'remove'])]
    private ?Periodicite $periodicite = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'taches')]
    private Collection $user;

    #[ORM\ManyToOne(inversedBy: 'createdTaches')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $creator = null;

    #[ORM\ManyToOne(inversedBy: 'taches')]
    private ?Compagnie $compagnie = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $echeance = null;

    public function __construct()
    {
        $this->user = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getComplexite(): ?string
    {
        return $this->complexite;
    }

    public function setComplexite(string $complexite): static
    {
        $this->complexite = $complexite;

        return $this;
    }

    public function getPriorite(): ?string
    {
        return $this->priorite;
    }

    public function setPriorite(string $priorite): static
    {
        $this->priorite = $priorite;

        return $this;
    }

    public function isEstRecurrente(): ?bool
    {
        return $this->est_recurrente;
    }

    public function setEstRecurrente(bool $est_recurrente): static
    {
        $this->est_recurrente = $est_recurrente;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeInterface $date_debut): static
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getMotCles(): ?string
    {
        return $this->mot_cles;
    }

    public function setMotCles(string $mot_cles): static
    {
        $this->mot_cles = $mot_cles;

        return $this;
    }

    public function getReferance(): ?string
    {
        return $this->referance;
    }

    public function setReferance(string $referance): static
    {
        $this->referance = $referance;

        return $this;
    }

    public function getReferanciel(): ?string
    {
        return $this->referanciel;
    }

    public function setReferanciel(string $referanciel): static
    {
        $this->referanciel = $referanciel;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;

        return $this;
    }



    public function getPeriodicite(): ?Periodicite
    {
        return $this->periodicite;
    }

    public function setPeriodicite(Periodicite $periodicite): static
    {
        // set the owning side of the relation if necessary
        if ($periodicite->getTache() !== $this) {
            $periodicite->setTache($this);
        }

        $this->periodicite = $periodicite;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): static
    {
        if (!$this->user->contains($user)) {
            $this->user->add($user);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        $this->user->removeElement($user);

        return $this;
    }

    public function getCreator(): ?User
    {
        return $this->creator;
    }

    public function setCreator(?User $creator): static
    {
        $this->creator = $creator;

        return $this;
    }

    public function getCompagnie(): ?Compagnie
    {
        return $this->compagnie;
    }

    public function setCompagnie(?Compagnie $compagnie): static
    {
        $this->compagnie = $compagnie;

        return $this;
    }

    public function getEcheance(): ?\DateTimeInterface
    {
        return $this->echeance;
    }

    public function setEcheance(\DateTimeInterface $echeance): static
    {
        $this->echeance = $echeance;

        return $this;
    }



}
