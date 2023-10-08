<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $email;

    #[ORM\Column(type: 'string', length: 180)]
    private $username;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\Column(length: 90, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $telephone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fonction = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $longue = null;

    #[ORM\ManyToMany(targetEntity: Role::class, mappedBy: 'user', cascade: ['persist', 'remove'])]
    private Collection $userRoles;

    #[ORM\ManyToOne(inversedBy: 'user', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: true)]
    private ?Compagnie $compagnie = null;

    #[ORM\OneToOne(mappedBy: 'user', cascade: ['persist', 'remove'])]
    private ?Adresse $adresse = null;

    #[ORM\ManyToMany(targetEntity: Tache::class, mappedBy: 'user', cascade: ['persist', 'remove'])]
    private Collection $taches;

    #[ORM\OneToMany(mappedBy: 'creator', targetEntity: Tache::class, cascade: ['persist', 'remove'])]
    private Collection $createdTaches;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Invetation::class, cascade: ['persist', 'remove'])]
    private Collection $invetations;

    public function __construct()
    {
        $this->userRoles = new ArrayCollection();
        $this->taches = new ArrayCollection();
        $this->createdTaches = new ArrayCollection();
        $this->invetations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */

    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getFonction(): ?string
    {
        return $this->fonction;
    }

    public function setFonction(string $fonction): static
    {
        $this->fonction = $fonction;

        return $this;
    }

    public function getLongue(): ?string
    {
        return $this->longue;
    }

    public function setLongue(string $longue): static
    {
        $this->longue = $longue;

        return $this;
    }

    /**
     * @return Collection<int, Role>
     */
    public function getRoleId(): Collection
    {
        return $this->userRoles;
    }

    public function addRoleId(Role $roleId): static
    {
        if (!$this->userRoles->contains($roleId)) {
            $this->userRoles->add($roleId);
            $roleId->addUser($this);
        }

        return $this;
    }

    public function removeRoleId(Role $roleId): static
    {
        if ($this->userRoles->removeElement($roleId)) {
            $roleId->removeUser($this);
        }

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


    public function getAdresse(): ?Adresse
    {
        return $this->adresse;
    }

    public function setAdresse(?Adresse $adresse): static
    {
        // unset the owning side of the relation if necessary
        if ($adresse === null && $this->adresse !== null) {
            $this->adresse->setUser(null);
        }

        // set the owning side of the relation if necessary
        if ($adresse !== null && $adresse->getUser() !== $this) {
            $adresse->setUser($this);
        }

        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return Collection<int, Role>
     */
    public function getUserRoles(): Collection
    {
        return $this->userRoles;
    }

    public function addUserRole(Role $userRole): static
    {
        if (!$this->userRoles->contains($userRole)) {
            $this->userRoles->add($userRole);
            $userRole->addUser($this);
        }

        return $this;
    }

    public function removeUserRole(Role $userRole): static
    {
        if ($this->userRoles->removeElement($userRole)) {
            $userRole->removeUser($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Tache>
     */
    public function getTaches(): Collection
    {
        return $this->taches;
    }

    public function addTach(Tache $tach): static
    {
        if (!$this->taches->contains($tach)) {
            $this->taches->add($tach);
            $tach->addUser($this);
        }

        return $this;
    }

    public function removeTach(Tache $tach): static
    {
        if ($this->taches->removeElement($tach)) {
            $tach->removeUser($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Tache>
     */
    public function getCreatedTaches(): Collection
    {
        return $this->createdTaches;
    }

    public function addCreatedTach(Tache $createdTach): static
    {
        if (!$this->createdTaches->contains($createdTach)) {
            $this->createdTaches->add($createdTach);
            $createdTach->setCreator($this);
        }

        return $this;
    }

    public function removeCreatedTach(Tache $createdTach): static
    {
        if ($this->createdTaches->removeElement($createdTach)) {
            // set the owning side to null (unless already changed)
            if ($createdTach->getCreator() === $this) {
                $createdTach->setCreator(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Invetation>
     */
    public function getInvetations(): Collection
    {
        return $this->invetations;
    }

    public function addInvetation(Invetation $invetation): static
    {
        if (!$this->invetations->contains($invetation)) {
            $this->invetations->add($invetation);
            $invetation->setUser($this);
        }

        return $this;
    }

    public function removeInvetation(Invetation $invetation): static
    {
        if ($this->invetations->removeElement($invetation)) {
            // set the owning side to null (unless already changed)
            if ($invetation->getUser() === $this) {
                $invetation->setUser(null);
            }
        }

        return $this;
    }
}
