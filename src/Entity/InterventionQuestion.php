<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\InterventionQuestionRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: InterventionQuestionRepository::class)]
#[ApiResource]

class InterventionQuestion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['interventionType'])]
    private ?string $question = null;

    #[ORM\Column(length: 255)]
    #[Groups(['interventionType'])]
    private ?string $questionType = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['interventionType'])]
    private ?array $choices = null;

    #[ORM\Column]
    #[Groups(['interventionType'])]
    private ?bool $required = null;

    #[ORM\ManyToOne(inversedBy: 'questions')]
    private ?InterventionType $interventionType = null;


    public function __toString()
    {
        return $this->question;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): static
    {
        $this->question = $question;

        return $this;
    }



    // ajouter type de question

    public function getQuestionType(): ?string
    {
        return $this->questionType;
    }

    public function setQuestionType(string $questionType): static
    {
        $this->questionType = $questionType;

        return $this;
    }
    // ajouter ajouter le type de réponse (choix mutliple ou pas)

    public function getChoices(): ?array
    {
        return $this->choices;
    }

    public function setChoices(?array $choices): static
    {
        $this->choices = $choices;

        return $this;
    }


    //question obligatoire ou pas 
    public function isRequired(): ?bool
    {
        return $this->required;
    }

    public function setRequired(bool $required): static
    {
        $this->required = $required;

        return $this;
    }

    public function getInterventionType(): ?InterventionType
    {
        return $this->interventionType;
    }

    public function setInterventionType(?InterventionType $interventionType): static
    {
        $this->interventionType = $interventionType;

        return $this;
    }
}
