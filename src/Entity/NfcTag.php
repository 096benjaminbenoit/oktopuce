<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Symfony\Component\Uid\Uuid;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiFilter;
use App\Repository\NfcTagRepository;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: NfcTagRepository::class)]
#[ApiResource(normalizationContext: ['groups' => ['equipment']])]
class NfcTag
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[ApiProperty(identifier: false)]
    private ?int $id = null;

    #[ORM\Column(type: Types::GUID)]
    #[ApiProperty(identifier: true)]
    private ?string $uid = null;

    #[ORM\OneToOne(targetEntity: Equipment::class, mappedBy: 'nfcTag')]
    #[Groups(['equipment'])]
    private ?Equipment $equipment = null;

    public function __toString()
    {
        return $this->uid;
    }

    public function __construct()
    {
     $this->uid = Uuid::v4();   
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUid(): ?string
    {
        return $this->uid;
    }

    public function setUid(string $uid): static
    {
        $this->uid = $uid;

        return $this;
    }

    public function getEquipment(): ?Equipment
    {
        return $this->equipment;
    }
}
