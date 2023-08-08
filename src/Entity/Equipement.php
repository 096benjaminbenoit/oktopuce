<?php

namespace App\Entity;

use App\Repository\EquipementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipementRepository::class)]
class Equipement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $installationDate = null;

    #[ORM\Column(length: 255)]
    private ?string $serialNumber = null;

    #[ORM\Column(length: 255)]
    private ?string $locationDetail = null;

    #[ORM\Column(length: 255)]
    private ?string $productType = null;

    #[ORM\Column(length: 255)]
    private ?string $placementType = null;

    #[ORM\Column(length: 255)]
    private ?string $remoteNumber = null;

    #[ORM\Column]
    private ?float $gasWeight = null;

    #[ORM\Column]
    private ?bool $leakDetection = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $nextLeakControl = null;

    #[ORM\Column]
    private array $finality = [];

    #[ORM\Column]
    private ?float $capacity = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $picto = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?NfcTag $nfc = null;

    #[ORM\ManyToOne(inversedBy: 'equipements')]
    private ?Location $location = null;

    #[ORM\ManyToOne(inversedBy: 'equipements')]
    private ?GasTypes $gas = null;

    #[ORM\ManyToOne(inversedBy: 'equipements')]
    private ?Brand $brand = null;

    #[ORM\OneToMany(mappedBy: 'equipement', targetEntity: Intervention::class)]
    private Collection $intervention;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'equipements')]
    private ?self $parent = null;

    #[ORM\OneToMany(mappedBy: 'parent', targetEntity: self::class)]
    private Collection $equipements;

    public function __construct()
    {
        $this->intervention = new ArrayCollection();
        $this->equipements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInstallationDate(): ?\DateTimeImmutable
    {
        return $this->installationDate;
    }

    public function setInstallationDate(\DateTimeImmutable $installationDate): static
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

    public function getLocationDetail(): ?string
    {
        return $this->locationDetail;
    }

    public function setLocationDetail(string $locationDetail): static
    {
        $this->locationDetail = $locationDetail;

        return $this;
    }

    public function getProductType(): ?string
    {
        return $this->productType;
    }

    public function setProductType(string $productType): static
    {
        $this->productType = $productType;

        return $this;
    }

    public function getPlacementType(): ?string
    {
        return $this->placementType;
    }

    public function setPlacementType(string $placement_type): static
    {
        $this->placementType = $placement_type;

        return $this;
    }

    public function getRemoteNumber(): ?string
    {
        return $this->remoteNumber;
    }

    public function setRemoteNumber(string $remoteNumber): static
    {
        $this->remoteNumber = $remoteNumber;

        return $this;
    }

    public function getGasWeight(): ?float
    {
        return $this->gasWeight;
    }

    public function setGasWeight(float $gasWeight): static
    {
        $this->gasWeight = $gasWeight;

        return $this;
    }

    public function isLeakDetection(): ?bool
    {
        return $this->leakDetection;
    }

    public function setLeakDetection(bool $leakDetection): static
    {
        $this->leakDetection = $leakDetection;

        return $this;
    }

    public function getNextLeakControl(): ?\DateTimeImmutable
    {
        return $this->nextLeakControl;
    }

    public function setNextLeakControl(\DateTimeImmutable $nextLeakControl): static
    {
        $this->nextLeakControl = $nextLeakControl;

        return $this;
    }

    public function getFinality(): array
    {
        return $this->finality;
    }

    public function setFinality(array $finality): static
    {
        $this->finality = $finality;

        return $this;
    }

    public function getCapacity(): ?float
    {
        return $this->capacity;
    }

    public function setCapacity(float $capacity): static
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

    public function getNfc(): ?NfcTag
    {
        return $this->nfc;
    }

    public function setNfc(?NfcTag $nfc): static
    {
        $this->nfc = $nfc;

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

    public function getGas(): ?GasTypes
    {
        return $this->gas;
    }

    public function setGas(?GasTypes $gas): static
    {
        $this->gas = $gas;

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

    /**
     * @return Collection<int, Intervention>
     */
    public function getIntervention(): Collection
    {
        return $this->intervention;
    }

    public function addIntervention(Intervention $intervention): static
    {
        if (!$this->intervention->contains($intervention)) {
            $this->intervention->add($intervention);
            $intervention->setEquipement($this);
        }

        return $this;
    }

    public function removeIntervention(Intervention $intervention): static
    {
        if ($this->intervention->removeElement($intervention)) {
            // set the owning side to null (unless already changed)
            if ($intervention->getEquipement() === $this) {
                $intervention->setEquipement(null);
            }
        }

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
    public function getEquipements(): Collection
    {
        return $this->equipements;
    }

    public function addEquipement(self $equipement): static
    {
        if (!$this->equipements->contains($equipement)) {
            $this->equipements->add($equipement);
            $equipement->setParent($this);
        }

        return $this;
    }

    public function removeEquipement(self $equipement): static
    {
        if ($this->equipements->removeElement($equipement)) {
            // set the owning side to null (unless already changed)
            if ($equipement->getParent() === $this) {
                $equipement->setParent(null);
            }
        }

        return $this;
    }
}
