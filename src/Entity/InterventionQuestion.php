<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\InterventionQuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InterventionQuestionRepository::class)]
#[ApiResource]
class InterventionQuestion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?string $question = null;

    #[ORM\ManyToMany(targetEntity: InterventionType::class, mappedBy: 'interventionQuestion')]
    private Collection $interventionTypes;

    public function __construct()
    {
        $this->interventionTypes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function type(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): static
    {
        $this->question = $question;

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
            $interventionType->addInterventionQuestion($this);
        }

        return $this;
    }

    public function removeInterventionType(InterventionType $interventionType): static
    {
        if ($this->interventionTypes->removeElement($interventionType)) {
            $interventionType->removeInterventionQuestion($this);
        }

        return $this;
    }
}
