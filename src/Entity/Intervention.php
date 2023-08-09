<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\InterventionRepository;

#[ORM\Entity(repositoryClass: InterventionRepository::class)]
#[ApiResource]

class Intervention
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $technicien = null;

    #[ORM\Column(length: 255)]
    private ?string $entreprise = null;

    #[ORM\Column(type: 'json')]
    private ?array $type = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $interventionDate = null;

    #[ORM\ManyToOne(inversedBy: 'intervention')]
    private ?Equipement $equipement = null;

    #[ORM\ManyToOne(inversedBy: 'interventions')]
    #[JoinColumn(nullable: true)]

    private ?Person $person = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTechnicien(): ?string
    {
        return $this->technicien;
    }

    public function setTechnicien(string $technicien): static
    {
        $this->technicien = $technicien;

        return $this;
    }

    public function getEntreprise(): ?string
    {
        return $this->entreprise;
    }

    public function setEntreprise(string $entreprise): static
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    public function getType(): ?array
    {
        return $this->type;
    }

    public function setType(array $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getInterventionDate(): ?\DateTimeImmutable
    {
        return $this->interventionDate;
    }

    public function setInterventionDate(\DateTimeImmutable $interventionDate): static
    {
        $this->interventionDate = $interventionDate;

        return $this;
    }

    public function getEquipement(): ?Equipement
    {
        return $this->equipement;
    }

    public function setEquipement(?Equipement $equipement): static
    {
        $this->equipement = $equipement;

        return $this;
    }

    public function getPerson(): ?Person
    {
        return $this->person;
    }

    public function setPerson(?Person $person): static
    {
        $this->person = $person;

        return $this;
    }
}
