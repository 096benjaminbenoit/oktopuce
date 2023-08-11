<?php

namespace App\EventListener;

use Doctrine\ORM\Events;

use App\Entity\Equipment;
use App\Services\LeakControlCalculator;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Event\PostUpdateEventArgs;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;


#[AsEntityListener(event: Events::preUpdate, method: 'preUpdate', entity: Equipment::class)]
#[AsEntityListener(event: Events::prePersist, method: 'prePersist', entity: Equipment::class)]
class EquipmentChangedListener
{
    public function preUpdate(Equipment $equipment, PreUpdateEventArgs $event): void
    {
        // vérifier si la date de la dernière vérification de fuite à changer
        if ($event->hasChangedField('lastLeakDetection')){
        
            // si oui, mettre à jour la date de la prochaine vérification
            $equipment->nextLeakDetection(LeakControlCalculator::getNextLeakControlDate($equipment));
        }
        
    }


    public function prePersist(Equipment $equipment, PrePersistEventArgs $event): void
    {
        // Lors de la création d'un nouvel équipement, si il y a une détections des fuites 
        if (!empty($equipment->getGas())){
                
            // alors je défini la date de la prochaine vérification dès le départ
            $equipment->setNextLeakControl(LeakControlCalculator::getNextLeakControlDate($equipment));
        }
    }

    

}