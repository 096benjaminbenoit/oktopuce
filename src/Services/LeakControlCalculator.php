<?php

declare(strict_types=1);

namespace App\Services;

use App\Entity\Equipment;
use DateTimeImmutable;
use Doctrine\ORM\Event\PostPersistEventArgs;

class LeakControlCalculator
{
    /**
     * Calcule et retourne la prochaine date de contrôle de fuite pour un équipement donné.
     * Si le contrôle n'est pas obligatoire, retourne null.
     *
     * @param Equipment $equipment L'équipement pour lequel calculer la date de contrôle.
     *
     * @return null|\DateTimeImmutable La prochaine date de contrôle ou null si le contrôle n'est pas obligatoire.
     */
    public static function getNextLeakControlDate(Equipment $equipment, DateTimeImmutable $dateBase): null|\DateTimeImmutable
    {
        // Vérifie si le contrôle est obligatoire
        if (!self::isControlMandatory($equipment)) {
            return null;
        }

        // Récupère la périodicité du contrôle
        $periodicity = self::getPeriodicity($equipment);

        // Récupère la date d'installation et la date de la dernière détection de fuite
        /* $dateInstallation = $equipment->getInstallationDate();
        $derniereDetectionFuite = $equipment->getLastLeakDetection();
        $dateIntervention = 

        // Si la date de la dernière détection de fuite est null, utilise la date d'installation comme base
        if ($derniereDetectionFuite === null) {
            $dateBase = $dateInstallation;
        } else {
            $dateBase = $derniereDetectionFuite;
        } */

        // Calcule et retourne la prochaine date de contrôle en ajoutant la périodicité à la date de base
        return $dateBase->add(
            \DateInterval::createFromDateString($periodicity)
        );
    }

    /**
     * Détermine la périodicité du contrôle en fonction des caractéristiques de l'équipement.
     *
     * @param Equipment $equipment L'équipement pour lequel déterminer la périodicité.
     *
     * @return string La périodicité du contrôle sous forme de chaîne.
     */
    public static function getPeriodicity(Equipment $equipment): string
    {
        $TCO2 = self::calculTCO2($equipment);

        if ($equipment->isHasLeakDetection()) {
            if ($TCO2 < 50_000) {
                return '+ 2 years';
            } elseif ($TCO2 < 500_000) {
                return '+ 6 months';
            } else {
                return '+ 6 months';
            }
        }

        if ($TCO2 < 5_000) {
            return '+ 1 year';
        } elseif ($TCO2 < 50_000) {
            return '+ 6 months';
        } else {
            return '+ 3 months';
        }
    }

    /**
     * Calcule le TCO2 (Total CO2) en fonction des caractéristiques de l'équipement.
     *
     * @param Equipment $equipment L'équipement pour lequel calculer le TCO2.
     *
     * @return float Le TCO2 calculé.
     */
    public static function calculTCO2(Equipment $equipment): float
    {
        $gas = $equipment->getGas();
        $quantity = $equipment->getGasWeight();
        $potential = $gas->getEqCo2PerKg();

        $TCO2 = $quantity * $potential;

        return $TCO2;
    }

    /**
     * Vérifie si le contrôle de fuite est obligatoire pour l'équipement en fonction de ses caractéristiques.
     *
     * @param Equipment $equipment L'équipement pour lequel vérifier l'obligation du contrôle.
     *
     * @return bool True si le contrôle est obligatoire, sinon False.
     */
    public static function isControlMandatory(Equipment $equipment): bool
    {
        return !($equipment->isHasLeakDetection() && self::calculTCO2($equipment) < 5000);
    }
}
