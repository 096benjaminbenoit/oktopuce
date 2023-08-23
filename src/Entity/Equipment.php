<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\EquipmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipmentRepository::class)]
#[ApiResource]
class Equipment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $installationDate = null;

    #[ORM\Column(length: 255)]
    private ?string $serialNumber = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'equipment')]
    private ?self $parent = null;

    #[ORM\OneToMany(mappedBy: 'parent', targetEntity: self::class)]
    private Collection $equipment;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?NfcTag $nfcTag = null;

    #[ORM\ManyToOne(inversedBy: 'equipment')]
    private ?Brand $brand = null;

    #[ORM\ManyToOne(inversedBy: 'equipment')]
    private ?Location $location = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $locationDetail = null;

    #[ORM\ManyToOne(inversedBy: 'equipment')]
    private ?EquipmentType $equipmentType = null;

    #[ORM\ManyToOne(inversedBy: 'equipment')]
    private ?Placement $placement = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $remoteNumber = null;

    #[ORM\ManyToOne(inversedBy: 'equipment')]
    private ?GasType $gas = null;

    #[ORM\Column(nullable: true)]
    private ?float $gasWeight = null;

    #[ORM\Column(nullable: true)]
    private ?bool $hasLeakDetection = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $lastLeakDetection = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $nextLeakDetection = null;

    #[ORM\ManyToMany(targetEntity: Finality::class, inversedBy: 'equipment')]
    private Collection $finality;

    #[ORM\Column(nullable: true)]
    private ?float $capacity = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $picto = null;

    #[ORM\OneToMany(mappedBy: 'equipment', targetEntity: Intervention::class)]
    private Collection $interventions;

    public function __construct()
    {
        $this->equipment = new ArrayCollection();
        $this->finality = new ArrayCollection();
        $this->interventions = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->serialNumber;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInstallationDate(): ?\DateTimeImmutable
    {
        return $this->installationDate;
    }

    public function setInstallationDate(?\DateTimeImmutable $installationDate): static
    {
        $this->installationDate = $installationDate;

        return $this;
    }

    public function getSerialNumber(): ?string
    {
        return $this->serialNumber;
    }

    public function setSerialNumber(string $serialNumber): static
    {
        $this->serialNumber = $serialNumber;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): static
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getEquipment(): Collection
    {
        return $this->equipment;
    }

    public function addEquipment(self $equipment): static
    {
        if (!$this->equipment->contains($equipment)) {
            $this->equipment->add($equipment);
            $equipment->setParent($this);
        }

        return $this;
    }

    public function removeEquipment(self $equipment): static
    {
        if ($this->equipment->removeElement($equipment)) {
            // set the owning side to null (unless already changed)
            if ($equipment->getParent() === $this) {
                $equipment->setParent(null);
            }
        }

        return $this;
    }

    public function getNfcTag(): ?NfcTag
    {
        return $this->nfcTag;
    }

    public function setNfcTag(?NfcTag $nfcTag): static
    {
        $this->nfcTag = $nfcTag;

        return $this;
    }

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getLocationDetail(): ?string
    {
        return $this->locationDetail;
    }

    public function setLocationDetail(?string $locationDetail): static
    {
        $this->locationDetail = $locationDetail;

        return $this;
    }

    public function getEquipmentType(): ?EquipmentType
    {
        return $this->equipmentType;
    }

    public function setEquipmentType(?EquipmentType $equipmentType): static
    {
        $this->equipmentType = $equipmentType;

        return $this;
    }

    public function getPlacement(): ?Placement
    {
        return $this->placement;
    }

    public function setPlacement(?Placement $placement): static
    {
        $this->placement = $placement;

        return $this;
    }

    public function getRemoteNumber(): ?string
    {
        return $this->remoteNumber;
    }

    public function setRemoteNumber(?string $remoteNumber): static
    {
        $this->remoteNumber = $remoteNumber;

        return $this;
    }

    public function getGas(): ?GasType
    {
        return $this->gas;
    }

    public function setGas(?GasType $gas): static
    {
        $this->gas = $gas;

        return $this;
    }

    public function getGasWeight(): ?float
    {
        return $this->gasWeight;
    }

    public function setGasWeight(?float $gasWeight): static
    {
        $this->gasWeight = $gasWeight;

        return $this;
    }

    public function isHasLeakDetection(): ?bool
    {
        return $this->hasLeakDetection;
    }

    public function setHasLeakDetection(?bool $hasLeakDetection): static
    {
        $this->hasLeakDetection = $hasLeakDetection;

        return $this;
    }

    public function getLastLeakDetection(): ?\DateTimeImmutable
    {
        return $this->lastLeakDetection;
    }

    public function setLastLeakDetection(?\DateTimeImmutable $lastLeakDetection): static
    {
        $this->lastLeakDetection = $lastLeakDetection;

        return $this;
    }

    public function getNextLeakDetection(): ?\DateTimeImmutable
    {
        return $this->nextLeakDetection;
    }

    public function setNextLeakDetection(?\DateTimeImmutable $nextLeakDetection): static
    {
        $this->nextLeakDetection = $nextLeakDetection;

        return $this;
    }

    /**
     * @return Collection<int, Finality>
     */
    public function getFinality(): Collection
    {
        return $this->finality;
    }

    public function addFinality(Finality $finality): static
    {
        if (!$this->finality->contains($finality)) {
            $this->finality->add($finality);
        }

        return $this;
    }

    public function removeFinality(Finality $finality): static
    {
        $this->finality->removeElement($finality);

        return $this;
    }

    public function getCapacity(): ?float
    {
        return $this->capacity;
    }

    public function setCapacity(?float $capacity): static
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getPicto(): ?string
    {
        return $this->picto;
    }

    public function setPicto(?string $picto): static
    {
        $this->picto = $picto;

        return $this;
    }

    /**
     * @return Collection<int, Intervention>
     */
    public function getInterventions(): Collection
    {
        return $this->interventions;
    }

    public function addIntervention(Intervention $intervention): static
    {
        if (!$this->interventions->contains($intervention)) {
            $this->interventions->add($intervention);
            $intervention->setEquipment($this);
        }

        return $this;
    }

    public function removeIntervention(Intervention $intervention): static
    {
        if ($this->interventions->removeElement($intervention)) {
            // set the owning side to null (unless already changed)
            if ($intervention->getEquipment() === $this) {
                $intervention->setEquipment(null);
            }
        }

        return $this;
    }
}
