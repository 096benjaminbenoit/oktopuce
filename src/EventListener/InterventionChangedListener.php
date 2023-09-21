<?php

namespace App\EventListener;

use App\Entity\Equipment;
use Doctrine\ORM\Events;

use App\Entity\Intervention;
use App\Services\LeakControlCalculator;
use DateTimeImmutable;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Event\PostUpdateEventArgs;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;

// Déclare cette classe en tant qu'écouteur d'événements pour l'entité Intervention
// Elle écoutera les événements preUpdate et prePersist pour cette entité
#[AsEntityListener(event: Events::preUpdate, method: 'preUpdate', entity: Intervention::class)]
#[AsEntityListener(event: Events::prePersist, method: 'prePersist', entity: Equipment::class)]
class InterventionChangedListener
{
    // Cette méthode est appelée avant la mise à jour d'une entité Intervention
    public function preUpdate(Intervention $intervention, PreUpdateEventArgs $event): void
    {
        // Vérifie si le champ 'lastLeakDetection' a été modifié lors de cette mise à jour
        $equipment = $intervention->getEquipment();
        // Si oui, met à jour la date de la prochaine vérification des fuites en utilisant le calculateur LeakControlCalculator
        $equipment->setNextLeakDetection(LeakControlCalculator::getNextLeakControlDate($equipment, $intervention->getInterventionDate()));
    }

    // Cette méthode est appelée avant la création d'une entité Equipment
    public function prePersist(Equipment $equipment, PrePersistEventArgs $event): void
    {
        // Lors de la création d'un nouvel équipement, vérifie s'il y a une détection de fuites et s'il y a du gaz
        if (!empty($equipment->getGas() && $equipment->isHasLeakDetection())) {

            // Crée une action pour obtenir la date actuelle et l'utilise comme date de prochaine vérification si elle est nulle
            $addDate = $equipment->getInstallationDate();
            if ($equipment->getNextLeakDetection() === null) {
                // $equipment->setNextLeakDetection($addDate);
                $equipment->setNextLeakDetection(LeakControlCalculator::getNextLeakControlDate($equipment, $addDate));
            }

            // Définit également la date de la prochaine vérification en utilisant le calculateur LeakControlCalculator
        }
    }
}
