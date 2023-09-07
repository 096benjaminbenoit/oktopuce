<?php

namespace App\EventListener;

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
#[AsEntityListener(event: Events::prePersist, method: 'prePersist', entity: Intervention::class)]
class InterventionChangedListener
{
    // Cette méthode est appelée avant la mise à jour d'une entité Intervention
    public function preUpdate(Intervention $intervention, PreUpdateEventArgs $event): void
    {
        // Vérifie si le champ 'lastLeakDetection' a été modifié lors de cette mise à jour
        if ($event->hasChangedField('lastLeakDetection')) {

            // Si oui, met à jour la date de la prochaine vérification des fuites en utilisant le calculateur LeakControlCalculator
            $intervention->setNextLeakDetection(LeakControlCalculator::getNextLeakControlDate($intervention));
        }
    }

    // Cette méthode est appelée avant la création d'une entité Equipment
    public function prePersist(Intervention $intervention, PrePersistEventArgs $event): void
    {
        // Lors de la création d'un nouvel équipement, vérifie s'il y a une détection de fuites et s'il y a du gaz
        if (!empty($intervention->getGas() && $intervention->isHasLeakDetection())) {

            // Crée une action pour obtenir la date actuelle et l'utilise comme date de prochaine vérification si elle est nulle
            if ($intervention->getNextLeakDetection() === null) {
                $addDate = $intervention->getInstallationDate();
                $intervention->setNextLeakDetection($addDate);
            }

            // Définit également la date de la prochaine vérification en utilisant le calculateur LeakControlCalculator
            $intervention->setNextLeakDetection(LeakControlCalculator::getNextLeakControlDate($intervention));
        }
    }
}
