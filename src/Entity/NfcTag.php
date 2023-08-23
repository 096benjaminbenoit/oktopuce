<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Symfony\Component\Uid\Uuid;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\NfcTagRepository;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: NfcTagRepository::class)]
#[ApiResource]
class NfcTag
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::GUID)]
    private ?string $uid = null;

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
}
