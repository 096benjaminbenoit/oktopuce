<?php

declare(strict_types=1);

namespace App\Services;

use App\Entity\equipment;
use Doctrine\ORM\Event\PostPersistEventArgs;

class LeakControlCalculator
{



    public static function getNextLeakControlDate(equipment $equipment): null|\DateTimeImmutable
    {
        if(!self::isControlMandatory($equipment)) {
            return null;
        }

        $periodicity = self::getPeriodicity($equipment);

        return $equipment->getLastLeakDetection()->add(
            \DateInterval::createFromDateString($periodicity)
        );
    }

    public static function getPeriodicity(equipment $equipment): string
    {
        $TCO2 = self::calculTCO2($equipment);
        if($equipment->isHasLeakDetection()){
            if($TCO2 < 50_000) {
                return '+ 2 years';
            } elseif ($TCO2 < 500_000) {
            
            return "+ 6 months";
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

    public static function calculTCO2(equipment $equipment): float
    {
        $gas = $equipment->getGas();

        $quantity = $equipment->getGasWeight();
        $potential = $gas->getEqCo2PerKg();

        $TCO2 = $quantity * $potential;

        return $TCO2;
    }

    public static function isControlMandatory(equipment $equipment): bool
    {
        return !($equipment->isHasLeakDetection() && self::calculTCO2($equipment) < 5000);
    }
}