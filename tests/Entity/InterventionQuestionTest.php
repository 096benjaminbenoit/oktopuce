<?php
use App\Entity\InterventionQuestion;
use App\Entity\InterventionType;
use PHPUnit\Framework\TestCase;

class InterventionQuestionTest extends TestCase
{
    public function testInterventionQuestionAttributes(): void
    {
        $interventionQuestion = new InterventionQuestion();

        $question = "What is the issue?";
        $interventionQuestion->setQuestion($question);
        $this->assertSame($question, $interventionQuestion->type());
    }

    public function testInterventionQuestionInterventionTypesCollection(): void
    {
        $interventionQuestion = new InterventionQuestion();

        $interventionType1 = new InterventionType();
        $interventionType2 = new InterventionType();

        $interventionQuestion->addInterventionType($interventionType1);
        $interventionQuestion->addInterventionType($interventionType2);

        $interventionTypesCollection = $interventionQuestion->getInterventionTypes();
        $this->assertCount(2, $interventionTypesCollection);
        $this->assertTrue($interventionTypesCollection->contains($interventionType1));
        $this->assertTrue($interventionTypesCollection->contains($interventionType2));

        $interventionQuestion->removeInterventionType($interventionType1);
        $this->assertCount(1, $interventionQuestion->getInterventionTypes());
        $this->assertFalse($interventionTypesCollection->contains($interventionType1));
    }

    // ... Ajoutez d'autres méthodes de test pour couvrir d'autres fonctionnalités
}
