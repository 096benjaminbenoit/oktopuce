<?php

namespace App\EventListener;

use DateTimeImmutable;

use Doctrine\ORM\Events;
use App\Entity\Equipment;
use App\Entity\Intervention;
use App\Services\LeakControlCalculator;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Event\PostUpdateEventArgs;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use PhpParser\Node\Stmt\Label;

// Déclare cette classe en tant qu'écouteur d'événements pour l'entité Intervention
// Elle écoutera les événements preUpdate et prePersist pour cette entité
#[AsEntityListener(event: Events::preUpdate, method: 'preUpdate', entity: Intervention::class)]
#[AsEntityListener(event: Events::prePersist, method: 'prePersist', entity: Intervention::class)]

class AnswerListerner
{
    public function updateNextLeakControlle(Equipment $equipment, DateTimeImmutable $dateBase)
    {
        return  $equipment->setNextLeakDetection(LeakControlCalculator::getNextLeakControlDate($equipment, $dateBase));
    }

    // Cette méthode est appelée avant la mise à jour d'une entité Intervention
    public function preUpdate(Intervention $intervention, PreUpdateEventArgs $event): void
    {
        $equipment = $intervention->getEquipment();

        $interventionType = $intervention->getInterventionType();
        $interventionQuestion = $interventionType->getQuestions();
        $answers = $intervention->getAnswers();


        // Vérifie si le champ 'lastLeakDetection' a été modifié lors de cette mise à jour
        // if ($interventionQuestion == "Controlle étanchéité des réseaux ?")

        foreach ($answers as $answer) {
            $label = $answer["question"]["label"];
            $label = \Transliterator::create('NFD; [:Nonspacing Mark:] Remove; NFC')
                ->transliterate($label);
            $label = strtolower($label);

            $needle = "etancheite";
            
            $answerIntervention = $answer["answer"];
            $answerIntervention = strtolower($answerIntervention);

            if (str_contains($label, $needle) && $answerIntervention == "oui" ) {

                // Si oui, met à jour la date de la prochaine vérification des fuites en utilisant le calculateur LeakControlCalculator
                $this->updateNextLeakControlle($equipment, $intervention->getInterventionDate());
            }
        }
    }

    // Cette méthode est appelée avant la création d'une entité Intervention
    public function prePersist(Intervention $intervention, PrePersistEventArgs $event): void
    {
        $equipment = $intervention->getEquipment();

        // Lors de la création d'un nouvel équipement, vérifie s'il y a une détection de fuites et s'il y a du gaz
        if (!empty($equipment->getGas() && $equipment->isHasLeakDetection())) {

            // Crée une action pour obtenir la date actuelle et l'utilise comme date de prochaine vérification si elle est nulle
            if ($equipment->getNextLeakDetection() === null) {
                $addDate = $equipment->getInstallationDate();
                $equipment->setNextLeakDetection($addDate);
            }

            // Définit également la date de la prochaine vérification en utilisant le calculateur LeakControlCalculator
            $equipment->setNextLeakDetection(LeakControlCalculator::getNextLeakControlDate($equipment, $intervention->getInterventionDate()));
        }
    }
}
