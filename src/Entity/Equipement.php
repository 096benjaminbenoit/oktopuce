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
    private ?\DateTimeImmutable $installation_date = null;

    #[ORM\Column(length: 255)]
    private ?string $serial_number = null;

    #[ORM\Column(length: 255)]
    private ?string $location_detail = null;

    #[ORM\Column(length: 255)]
    private ?string $product_type = null;

    #[ORM\Column(length: 255)]
    private ?string $placement_type = null;

    #[ORM\Column(length: 255)]
    private ?string $remote_number = null;

    #[ORM\Column]
    private ?float $gas_weight = null;

    #[ORM\Column]
    private ?bool $leak_detection = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $next_leak_control = null;

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
        return $this->installation_date;
    }

    public function setInstallationDate(\DateTimeImmutable $installation_date): static
    {
        $this->installation_date = $installation_date;

        return $this;
    }

    public function getSerialNumber(): ?string
    {
        return $this->serial_number;
    }

    public function setSerialNumber(string $serial_number): static
    {
        $this->serial_number = $serial_number;

        return $this;
    }

    public function getLocationDetail(): ?string
    {
        return $this->location_detail;
    }

    public function setLocationDetail(string $location_detail): static
    {
        $this->location_detail = $location_detail;

        return $this;
    }

    public function getProductType(): ?string
    {
        return $this->product_type;
    }

    public function setProductType(string $product_type): static
    {
        $this->product_type = $product_type;

        return $this;
    }

    public function getPlacementType(): ?string
    {
        return $this->placement_type;
    }

    public function setPlacementType(string $placement_type): static
    {
        $this->placement_type = $placement_type;

        return $this;
    }

    public function getRemoteNumber(): ?string
    {
        return $this->remote_number;
    }

    public function setRemoteNumber(string $remote_number): static
    {
        $this->remote_number = $remote_number;

        return $this;
    }

    public function getGasWeight(): ?float
    {
        return $this->gas_weight;
    }

    public function setGasWeight(float $gas_weight): static
    {
        $this->gas_weight = $gas_weight;

        return $this;
    }

    public function isLeakDetection(): ?bool
    {
        return $this->leak_detection;
    }

    public function setLeakDetection(bool $leak_detection): static
    {
        $this->leak_detection = $leak_detection;

        return $this;
    }

    public function getNextLeakControl(): ?\DateTimeImmutable
    {
        return $this->next_leak_control;
    }

    public function setNextLeakControl(\DateTimeImmutable $next_leak_control): static
    {
        $this->next_leak_control = $next_leak_control;

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
