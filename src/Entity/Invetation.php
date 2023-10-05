<?php

namespace App\Entity;

use App\Repository\InvetationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvetationRepository::class)]
class Invetation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $date_validation = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $fin_demo = null;

    #[ORM\Column]
    private ?bool $isConfirmed = null;

    #[ORM\ManyToOne(inversedBy: 'invetations')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateValidation(): ?\DateTimeImmutable
    {
        return $this->date_validation;
    }

    public function setDateValidation(\DateTimeImmutable $date_validation): static
    {
        $this->date_validation = $date_validation;

        return $this;
    }

    public function getFinDemo(): ?\DateTimeImmutable
    {
        return $this->fin_demo;
    }

    public function setFinDemo(\DateTimeImmutable $fin_demo): static
    {
        $this->fin_demo = $fin_demo;

        return $this;
    }

    public function isIsConfirmed(): ?bool
    {
        return $this->isConfirmed;
    }

    public function setIsConfirmed(bool $isConfirmed): static
    {
        $this->isConfirmed = $isConfirmed;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
