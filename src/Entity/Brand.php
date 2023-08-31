<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\BrandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BrandRepository::class)]
#[ApiResource]
class Brand
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    // #[Groups('equipment')]

    private string $name ;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $savNumber = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $savLink = null;

    #[ORM\OneToMany(mappedBy: 'brand', targetEntity: Model::class , cascade:['persist'])]
    private Collection $models;

    #[ORM\OneToMany(mappedBy: 'brand', targetEntity: Equipment::class)]
    private Collection $equipment;

    public function __construct()
    {
        $this->models = new ArrayCollection();
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

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSavNumber(): ?string
    {
        return $this->savNumber;
    }

    public function setSavNumber(?string $savNumber): static
    {
        $this->savNumber = $savNumber;

        return $this;
    }

    public function getSavLink(): ?string
    {
        return $this->savLink;
    }

    public function setSavLink(?string $savLink): static
    {
        $this->savLink = $savLink;

        return $this;
    }

    /**
     * @return Collection<int, Model>
     */
    public function getModels(): Collection
    {
        return $this->models;
    }

    public function addModel(Model $model): static
    {
        if (!$this->models->contains($model)) {
            $this->models->add($model);
            $model->setBrand($this);
        }

        return $this;
    }

    public function removeModel(Model $model): static
    {
        if ($this->models->removeElement($model)) {
            // set the owning side to null (unless already changed)
            if ($model->getBrand() === $this) {
                $model->setBrand(null);
            }
        }

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
            $equipment->setBrand($this);
        }

        return $this;
    }

    public function removeEquipment(Equipment $equipment): static
    {
        if ($this->equipment->removeElement($equipment)) {
            // set the owning side to null (unless already changed)
            if ($equipment->getBrand() === $this) {
                $equipment->setBrand(null);
            }
        }

        return $this;
    }
}
