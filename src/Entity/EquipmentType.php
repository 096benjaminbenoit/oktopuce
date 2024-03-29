<?php

namespace App\Entity;

use App\Entity\Equipment;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\EquipmentTypeRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: EquipmentTypeRepository::class)]
#[ApiResource]
class EquipmentType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups('equipment')]
    private ?string $type = null;

    #[ORM\OneToMany(mappedBy: 'equipmentType', targetEntity: Equipment::class)]
    private Collection $equipment;

    #[ORM\ManyToMany(targetEntity: InterventionType::class, mappedBy: 'equipmentTypes')]
    private Collection $interventionTypes;

    public function __construct()
    {
        $this->equipment = new ArrayCollection();
        $this->interventionTypes = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->type;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, Equipment>
     */
    public function getEquipment(): Collection
    {
        return $this->equipment;
    }

    public function addEquipment(Equipment $equipment): static
    {
        if (!$this->equipment->contains($equipment)) {
            $this->equipment->add($equipment);
            $equipment->setEquipmentType($this);
        }

        return $this;
    }

    public function removeEquipment(Equipment $equipment): static
    {
        if ($this->equipment->removeElement($equipment)) {
            // set the owning side to null (unless already changed)
            if ($equipment->getEquipmentType() === $this) {
                $equipment->setEquipmentType(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, InterventionType>
     */
    public function getInterventionTypes(): Collection
    {
        return $this->interventionTypes;
    }

    public function addInterventionType(InterventionType $interventionType): static
    {
        if (!$this->interventionTypes->contains($interventionType)) {
            $this->interventionTypes->add($interventionType);
            $interventionType->addEquipmentType($this);
        }

        return $this;
    }

    public function removeInterventionType(InterventionType $interventionType): static
    {
        if ($this->interventionTypes->removeElement($interventionType)) {
            $interventionType->removeEquipmentType($this);
        }

        return $this;
    }
}
