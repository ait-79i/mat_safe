<?php

namespace App\Entity;

use App\Repository\CompagnieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompagnieRepository::class)]
class Compagnie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    private ?string $siret = null;

    #[ORM\OneToMany(mappedBy: 'compagnie', targetEntity: User::class, cascade: ['persist', 'remove'])]
    private Collection $user;

    #[ORM\OneToMany(mappedBy: 'compagnie', targetEntity: Adresse::class, cascade: ['persist', 'remove'])]
    private Collection $adresses;

    #[ORM\OneToMany(mappedBy: 'compagnie', targetEntity: SousCompagnie::class, cascade: ['persist', 'remove'])]
    private Collection $sousCompagnies;

    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->adresses = new ArrayCollection();
        $this->sousCompagnies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(string $siret): static
    {
        $this->siret = $siret;

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
            $user->setCompagnie($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->user->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getCompagnie() === $this) {
                $user->setCompagnie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Adresse>
     */
    public function getAdresses(): Collection
    {
        return $this->adresses;
    }

    public function addAdress(Adresse $adress): static
    {
        if (!$this->adresses->contains($adress)) {
            $this->adresses->add($adress);
            $adress->setCompagnie($this);
        }

        return $this;
    }

    public function removeAdress(Adresse $adress): static
    {
        if ($this->adresses->removeElement($adress)) {
            // set the owning side to null (unless already changed)
            if ($adress->getCompagnie() === $this) {
                $adress->setCompagnie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, SousCompagnie>
     */
    public function getSousCompagnies(): Collection
    {
        return $this->sousCompagnies;
    }

    public function addSousCompagny(SousCompagnie $sousCompagny): static
    {
        if (!$this->sousCompagnies->contains($sousCompagny)) {
            $this->sousCompagnies->add($sousCompagny);
            $sousCompagny->setCompagnie($this);
        }

        return $this;
    }

    public function removeSousCompagny(SousCompagnie $sousCompagny): static
    {
        if ($this->sousCompagnies->removeElement($sousCompagny)) {
            // set the owning side to null (unless already changed)
            if ($sousCompagny->getCompagnie() === $this) {
                $sousCompagny->setCompagnie(null);
            }
        }

        return $this;
    }
}
