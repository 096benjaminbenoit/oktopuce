<?php

declare(strict_types=1);

namespace App\Services;

use App\Entity\Equipement;
use Doctrine\ORM\Event\PostPersistEventArgs;

class LeakControlCalculator
{



    public static function getNextLeakControlDate(Equipement $equipment): null|\DateTimeImmutable
    {
        if(!self::isControlMandatory($equipment)) {
            return null;
        }

        $periodicity = self::getPeriodicity($equipment);

        return $equipment->getLastLeakDetection()->add(
            \DateInterval::createFromDateString($periodicity)
        );
    }

    public static function getPeriodicity(Equipement $equipment): string
    {
        $TCO2 = self::calculTCO2($equipment);
        if($equipment->isLeakDetection()){
            if($TCO2 < 50_000) {
                return '+ 2 years';
            } elseif ($TCO2 < 500_000) {
                return '+ 1 years';
            } else {
                return '+ 6 months';
            }
        }

        if($TCO2 < 5_000) {
            return '+ 1 years';
        } elseif ($TCO2 < 50_000) {
            return '+ 6 months';
        } else {
            return '+ 3 months';
        }
    }

    public static function calculTCO2(Equipement $equipment): float
    {
        $gas = $equipment->getGas();

        $quantity = $equipment->getGasWeight();
        $potential = $gas->getEqCo2PerKg();

        $TCO2 = $quantity * $potential;

        return $TCO2;
    }

    public static function isControlMandatory(Equipement $equipment): bool
    {
        return !($equipment->isLeakDetection() && self::calculTCO2($equipment) < 5000);
    }
}