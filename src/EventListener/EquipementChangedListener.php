<?php

namespace App\EventListener;

use Doctrine\ORM\Events;
use App\Entity\Equipement;
use App\Services\LeakControlCalculator;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Event\PostUpdateEventArgs;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;


#[AsEntityListener(event: Events::preUpdate, method: 'preUpdate', entity: Equipement::class)]
#[AsEntityListener(event: Events::prePersist, method: 'prePersist', entity: Equipement::class)]
class EquipementChangedListener
{
    public function preUpdate(Equipement $equipement, PreUpdateEventArgs $event): void
    {
        // vérifier si la date de la dernière vérification de fuite à changer
        if ($event->hasChangedField('lastLeakDetection')){
        
            // si oui, mettre à jour la date de la prochaine vérification
            $equipement->setNextLeakControl(LeakControlCalculator::getNextLeakControlDate($equipement));
        }
        
    }


    public function prePersist(Equipement $equipement, PrePersistEventArgs $event): void
    {
        // Lors de la création d'un nouvel équipement, si il y a une détections des fuites 
        if (!empty($equipement->getGas())){
                
            // alors je défini la date de la prochaine vérification dès le départ
            $equipement->setNextLeakControl(LeakControlCalculator::getNextLeakControlDate($equipement));
        }
    }

    

}