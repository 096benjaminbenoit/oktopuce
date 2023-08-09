<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\GasTypesRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: GasTypesRepository::class)]
#[ApiResource]

class GasTypes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?float $eqCo2PerKg = null;

    #[ORM\OneToMany(mappedBy: 'gas', targetEntity: Equipement::class)]
    private Collection $equipements;

    public function __toString()
    {
        return $this->name;
    }

    public function __construct()
    {
        $this->equipements = new ArrayCollection();
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
     * @return Collection<int, Equipement>
     */
    public function getEquipements(): Collection
    {
        return $this->equipements;
    }

    public function addEquipement(Equipement $equipement): static
    {
        if (!$this->equipements->contains($equipement)) {
            $this->equipements->add($equipement);
            $equipement->setGas($this);
        }

        return $this;
    }

    public function removeEquipement(Equipement $equipement): static
    {
        if ($this->equipements->removeElement($equipement)) {
            // set the owning side to null (unless already changed)
            if ($equipement->getGas() === $this) {
                $equipement->setGas(null);
            }
        }

        return $this;
    }
}