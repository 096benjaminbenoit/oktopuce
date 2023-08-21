<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
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

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $technician = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $enterprise = null;

    #[ORM\ManyToOne(inversedBy: 'interventions')]
    private ?Person $person = null;

    #[ORM\ManyToOne(inversedBy: 'interventions')]
    private ?Equipment $equipment = null;

    #[ORM\Column]
    private array $response = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTechnician(): ?string
    {
        return $this->technician;
    }

    public function setTechnician(?string $technician): static
    {
        $this->technician = $technician;

        return $this;
    }

    public function getEnterprise(): ?string
    {
        return $this->enterprise;
    }

    public function setEnterprise(?string $enterprise): static
    {
        $this->enterprise = $enterprise;

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

    public function getEquipment(): ?Equipment
    {
        return $this->equipment;
    }

    public function setEquipment(?Equipment $equipment): static
    {
        $this->equipment = $equipment;

        return $this;
    }

    public function getResponse(): array
    {
        return $this->response;
    }

    public function setResponse(array $response): static
    {
        $this->response = $response;

        return $this;
    }
}
