<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\GasTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GasTypeRepository::class)]
#[ApiResource]
class GasType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?float $eqCo2PerKg = null;

    #[ORM\OneToMany(mappedBy: 'gas', targetEntity: Equipment::class)]
    private Collection $equipment;

    public function __construct()
    {
        $this->equipment = new ArrayCollection();
    }
    public function __toString()
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getEqCo2PerKg(): ?float
    {
        return $this->eqCo2PerKg;
    }

    public function setEqCo2PerKg(float $eqCo2PerKg): static
    {
        $this->eqCo2PerKg = $eqCo2PerKg;

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
            $equipment->setGas($this);
        }

        return $this;
    }

    public function removeEquipment(Equipment $equipment): static
    {
        if ($this->equipment->removeElement($equipment)) {
            // set the owning side to null (unless already changed)
            if ($equipment->getGas() === $this) {
                $equipment->setGas(null);
            }
        }

        return $this;
    }
}
