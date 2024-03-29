<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use App\Entity\InterventionType;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\InterventionRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

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

    
    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    #[Groups('equipment')]
    private ?\DateTimeInterface $interventionDate = null;

    #[ORM\ManyToOne(inversedBy: 'interventions')]
    #[Groups('equipmentDetails')]
    #[ORM\JoinColumn(nullable: false)]
    private ?InterventionType $interventionType = null;

    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $answers = null;

    public function __construct()
    {
        $this->interventionDate = new \DateTimeImmutable("now");
    }

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

    public function getInterventionDate(): ?\DateTimeInterface
    {
        return $this->interventionDate;
    }

    public function setInterventionDate(\DateTimeInterface $interventionDate): static
    {
        $this->interventionDate = $interventionDate;

        return $this;
    }

    public function getInterventionType(): ?InterventionType
    {
        return $this->interventionType;
    }

    public function setInterventionType(?InterventionType $interventionType): static
    {
        $this->interventionType = $interventionType;

        return $this;
    }

    public function getAnswers(): ?array
    {
        return $this->answers;
    }

    public function setAnswers(?array $answers): static
    {
        $this->answers = $answers;

        return $this;
    }
}
