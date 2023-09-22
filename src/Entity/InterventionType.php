<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\InterventionTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: InterventionTypeRepository::class)]
#[ApiResource(normalizationContext: ['groups' => ['interventionType']])]
class InterventionType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['interventionType', 'equipmentDetails'])]
    private ?string $type = null;


    #[ORM\OneToMany(mappedBy: 'interventionType', targetEntity: Intervention::class)]
    private Collection $interventions;

    #[ORM\OneToMany(mappedBy: 'interventionType', targetEntity: InterventionQuestion::class, orphanRemoval: true, cascade: ['persist', 'remove'])]
    #[Groups(['interventionType'])]
    private Collection $questions;

    #[ORM\ManyToMany(targetEntity: EquipmentType::class, inversedBy: 'interventionTypes')]
    #[Groups(['interventionType'])]
    private Collection $equipmentTypes;

    public function __toString()
    {
        return $this->type;
    }

    public function __construct()
    {
        $this->questions = new ArrayCollection();
        $this->interventions = new ArrayCollection();
        $this->equipmentTypes = new ArrayCollection();
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
     * @return Collection<int, InterventionQuestion>
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(InterventionQuestion $question): static
    {
        if (!$this->questions->contains($question)) {
            $this->questions->add($question);
            $question->setInterventionType($this);
        }

        return $this;
    }

    public function removeQuestion(InterventionQuestion $question): static
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getInterventionType() === $this) {
                $question->setInterventionType(null);
            }
        }

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
            $intervention->setInterventionType($this);
        }

        return $this;
    }

    public function removeIntervention(Intervention $intervention): static
    {
        if ($this->interventions->removeElement($intervention)) {
            // set the owning side to null (unless already changed)
            if ($intervention->getInterventionType() === $this) {
                $intervention->setInterventionType(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, EquipmentType>
     */
    public function getEquipmentTypes(): Collection
    {
        return $this->equipmentTypes;
    }

    public function addEquipmentType(EquipmentType $equipmentType): static
    {
        if (!$this->equipmentTypes->contains($equipmentType)) {
            $this->equipmentTypes->add($equipmentType);
        }

        return $this;
    }

    public function removeEquipmentType(EquipmentType $equipmentType): static
    {
        $this->equipmentTypes->removeElement($equipmentType);

        return $this;
    }
}
