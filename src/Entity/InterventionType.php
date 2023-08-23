<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\InterventionTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InterventionTypeRepository::class)]
#[ApiResource]
class InterventionType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\ManyToMany(targetEntity: InterventionQuestion::class, inversedBy: 'interventionTypes')]
    private Collection $interventionQuestion;

    #[ORM\ManyToMany(targetEntity: Intervention::class, mappedBy: 'inventionType')]
    private Collection $interventions;

    public function __construct()
    {
        $this->interventionQuestion = new ArrayCollection();
        $this->interventions = new ArrayCollection();
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
    public function getInterventionQuestion(): Collection
    {
        return $this->interventionQuestion;
    }

    public function addInterventionQuestion(InterventionQuestion $interventionQuestion): static
    {
        if (!$this->interventionQuestion->contains($interventionQuestion)) {
            $this->interventionQuestion->add($interventionQuestion);
        }

        return $this;
    }

    public function removeInterventionQuestion(InterventionQuestion $interventionQuestion): static
    {
        $this->interventionQuestion->removeElement($interventionQuestion);

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
            $intervention->addInterventionType($this);
        }

        return $this;
    }

    public function removeIntervention(Intervention $intervention): static
    {
        if ($this->interventions->removeElement($intervention)) {
            $intervention->removeInterventionType($this);
        }

        return $this;
    }
}
