<?php

namespace App\DataFixtures;

use App\Entity\EquipmentType;
use App\Entity\InterventionType;
use App\Entity\InterventionQuestion;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;


class EquipmentTypeFixtures extends Fixture implements FixtureGroupInterface
{
    public function createQuestion($question)
    {
        [$name, $type] = $question;

        return (new InterventionQuestion())
            ->setQuestion($name)
            ->setQuestionType($type)
            ->setRequired(false);
    }
    public function createIntervetion(ObjectManager $manager, array $climatisations, string $typeInterventionName, array $interventions): void
    {
        foreach ($interventions as $intervention) {
            $typeIntervention = (new InterventionType())
                ->setType($typeInterventionName);
            foreach ($intervention["typeEquipment"] as $typeEquipment) {
                $typeIntervention->addEquipmentType($climatisations[$typeEquipment]);
            }
            foreach ($intervention["questions"] as $question) {
                $typeIntervention->addQuestion($this->createQuestion($question));
            }
            $typeIntervention->addQuestion($this->createQuestion(["Information complementaire", "text"]));
            $manager->persist($typeIntervention);
        }
    }

    public function load(ObjectManager $manager): void
    {
        $miseEnService = [
            [
                "typeEquipment" => ['Cassette', 'Console', 'Gainable', 'Plafonnier', 'Mural'],
                "questions" => [
                    ["Pose de l’unité", "checkbox"],
                    ["Réalisation des raccords électriques", "checkbox"],
                    ["Réalisation des raccords frigorifiques", "checkbox"],
                    ["Réalisation de l’évacuation des condensats", "checkbox"],
                    ["Contrôle étanchéité des réseaux", "checkbox"],
                    ["Essais de fonctionnement", "checkbox"],
                ],
            ],
            [
                "typeEquipment" => ['Monobloc'],
                "questions" => [
                    ["Pose de l’unité", "checkbox"],
                    ["Réalisation des percements entrée/sortie d’air", "checkbox"],
                    ["Réalisation des raccords électriques", "checkbox"],
                    ["Réalisation de l’évacuation des condensats", "checkbox"],
                    ["Essais de fonctionnement", "checkbox"],
                ]
            ],
            [
                "typeEquipment" => ['Unité simple ventilateur', 'Unité double ventilateur', 'Unité VRV'],
                "questions" => [
                    ["Pose de l’unité", "checkbox"],
                    ["Réalisation des raccords électriques", "checkbox"],
                    ["Réalisation des raccords frigorifiques", "checkbox"],
                    ["Réalisation de l’évacuation des condensats", "checkbox"],
                    ["Tirage au vide", "checkbox"],
                    ["Contrôle étanchéité des réseaux", "checkbox"],
                    ["Essais de fonctionnement", "checkbox"],
                ]

            ]
        ];
        $entretien = [
            [
                "typeEquipment" => ['Cassette', 'Console', 'Monobloc', 'Plafonnier', 'Mural'],
                "questions" => [
                    ["Netoyage des filtres", "checkbox"],
                    ["Désinfection échangeur", "checkbox"],
                    ["Netoyage de la turbine", "checkbox"],
                    ["Contrôle évacuation des condensats", "checkbox"],
                    ["Contrôle des serrages électriques", "checkbox"],
                    ["Contrôle étanchéité des réseaux", "checkbox"],
                    ["Contrôle des températures de soufflage", "checkbox"],
                ]
            ],
            [
                "typeEquipment" => ['Gainable'],
                "questions" => [
                    ["Netoyage ou remplacement des filtres", "checkbox"],
                    ["Désinfection échangeur", "checkbox"],
                    ["Désinfection réseau de gaines", "checkbox"],
                    ["Netoyage de la turbine", "checkbox"],
                    ["Contrôle évacuation des condensats", "checkbox"],
                    ["Contrôle des serrages électriques", "checkbox"],
                    ["Contrôle étanchéité des réseaux", "checkbox"],
                    ["Contrôle des températures de soufflage", "checkbox"],
                    ["Contrôle de la régulation", "checkbox"],
                ]

            ],
            [
                "typeEquipment" => ['Unité simple ventilateur', 'Unité double ventilateur', 'Unité VRV'],
                "questions" => [
                    ["Netoyage échangeur", "checkbox"],
                    ["Contrôle des serrages électriques", "checkbox"],
                    ["Contrôle étanchéité des réseaux", "checkbox"],
                    ["Contrôle des pressions", "checkbox"],
                ]
            ]
        ];
        $depanage = [
            [
                "typeEquipment" => [
                    'Cassette', 'Console', 'Monobloc', 'Plafonnier', 'Mural',
                    'Gainable',
                    'Unité simple ventilateur', 'Unité double ventilateur', 'Unité VRV',
                ],
                "questions" => [
                    ["Description du problème", "text"],
                    ["Code défaut", "text"],
                    ["Défaut indiqué", "text"],
                    ["Contact station technique", "checkbox"],
                    ["Numéro de dossier", "text"],
                    ["Description interventions réalisées", "text"],
                    ["Problème corrigé", "checkbox"],
                    ["Nouvelle intervention à prévoir", "checkbox"],
                ],
            ]
        ];
        $depose = [
            [
                "typeEquipment" => ['Cassette', 'Console', 'Gainable', 'Plafonnier', 'Mural'],
                "questions" => [
                    ["Unité intérieure", "checkbox"],
                    ["Câblage", "checkbox"],
                    ["Cuivre", "checkbox"],
                    ["Evacuation des condensats", "checkbox"],
                    ["Autre", "optionalText"],
                    ["Récupération du fluide dans unité extérieure", "checkbox"],
                    ["Repose prévue au même emplacement", "checkbox"],
                ]
            ],
            [
                "typeEquipment" => ['Monobloc'],
                "questions" => [
                    // Elément(s) déposé(s) :
                    ["Unité intérieure", "checkbox"],
                    ["Câblage", "checkbox"],
                    ["Evacuation des condensats", "checkbox"],
                    ["Autre", "optionalText"],
                    ["Récupération du fluide dans unité extérieure", "checkbox"],
                    ["Repose prévue au même emplacement", "checkbox"],
                ],
            ],
            [

                "typeEquipment" => ['Unité simple ventilateur', 'Unité double ventilateur', 'Unité VRV'],
                "questions" => [
                    ["Unité extérieure", "checkbox"],
                    ["Câblage", "checkbox"],
                    ["Cuivre", "checkbox"],
                    ["Evacuation d’eau", "checkbox"],
                    ["Autre", "optionalText"],
                    ["Récupération du fluide dans unité extérieure", "checkbox"],
                    ["Repose prévue au même emplacement", "checkbox"],
                    ["Informations complémentaires", "text"],
                ]

            ]
        ];
        $repose = [
            [
                "typeEquipment" => ['Cassette', 'Console', 'Gainable', 'Plafonnier', 'Mural'],
                "questions" => [
                    // Elément(s) déposé(s) :
                    ["Unité intérieure", "checkbox"],
                    ["Câblage", "checkbox"],
                    ["Cuivre", "checkbox"],
                    ["Evacuation des condensats", "checkbox"],
                    ["Autre", "optionalText"],
                    ["Réalisation mise en service", "checkbox"],
                    ["Si OUI (réalisation mise en service) alors : Essais", "checkbox"],
                ]
            ],
            [
                "typeEquipment" => ['Monobloc'],
                "questions" => [
                    // Elément(s) déposé(s) :
                    ["Unité intérieure", "checkbox"],
                    ["Câblage", "checkbox"],
                    ["Evacuation des condensats", "checkbox"],
                    ["Autre", "optionalText"],
                    ["Réalisation mise en service", "checkbox"],
                    ["Si OUI (réalisation mise en service) alors : Essais", "checkbox"],
                ]
            ],
            [
                "typeEquipment" => ['Unité simple ventilateur', 'Unité double ventilateur', 'Unité VRV'],
                "questions" => [
                    ["Unité extérieure", "checkbox"],
                    ["Câblage", "checkbox"],
                    ["Cuivre", "checkbox"],
                    ["Evacuation d’eau", "checkbox"],
                    ["Autre", "optionalText"],
                    ["Tirage au vide, Réalisation mise en service", "checkbox"],
                    ["Contrôle étanchéité des réseaux", "checkbox"],
                    ["Ouverture des vannes", "checkbox"],
                    ["Essais", "checkbox"],
                ]

            ]
        ];
        $deposeDefinitive = [
            [
                "typeEquipment" => ['Cassette', 'Console', 'Gainable', 'Plafonnier', 'Mural'],
                "questions" => [
                    ["Unité intérieure", "checkbox"],
                    ["Câblage", "checkbox"],
                    ["Cuivre", "checkbox"],
                    ["Evacuation des condensats", "checkbox"],
                    ["Autre", "optionalText"],

                    ["Installation nouveau appareil", "checkbox"],
                ]
            ],
            [
                "typeEquipment" => ['Monobloc'],
                "questions" => [
                    // Elément(s) déposé(s) :
                    ["Unité intérieure", "checkbox"],
                    ["Câblage", "checkbox"],
                    ["Cuivre", "checkbox"],
                    ["Evacuation des condensats", "checkbox"],
                    ["Autre", "optionalText"],
                    ["Installation nouveau appareil", "checkbox"],
                ],
            ],
            [

                "typeEquipment" => ['Unité simple ventilateur', 'Unité double ventilateur', 'Unité VRV'],
                "questions" => [
                    ["Unité extérieure", "checkbox"],
                    ["Câblage", "checkbox"],
                    ["Cuivre", "checkbox"],
                    ["Evacuation d’eau", "checkbox"],
                    ["Autre", "optionalText"],
                    ["Récupération du fluide dans unité extérieure", "checkbox"],
                    ["Installation nouveau appareil", "checkbox"],
                ]

            ]
        ];

        $typeEquipementsRaw = [
            'Climatisation' => [
                ['Cassette', 'Console', 'Gainable', 'Monobloc', 'Mural', 'Plafonnier'],
                ['Unité simple ventilateur', 'Unité double ventilateur', 'Unité VRV'],
            ],
            'Pompe à chaleur' => [
                ['Module intérieur', 'Unité extérieur simple ventilateur', 'Unité extérieur double ventilateur'],
                ['Unité Monobloc simple ventilateur', 'Unité Monobloc double ventilateur'],
            ],
            'Chauffe eau thermodynamique' => [
                ['Ballon Monobloc', 'Ballon Bi-bloc', 'Unité simple ventilateur', 'unite double ventilateur'],
                [],
            ],
        ];

        foreach ($typeEquipementsRaw as $typeName => [$inside, $outside]) {
            foreach ($inside as $typeName2) {
                $type = $type = "$typeName - Interieur - $typeName2";
                $typeEquipement = $typeEquipements[$typeName][$typeName2] = (new EquipmentType())
                    ->setType($type);
                $manager->persist($typeEquipement);
            }
            foreach ($outside as $typeName2) {
                $type = "$typeName - Exterieur - $typeName2";
                $typeEquipement = $typeEquipements[$typeName][$typeName2] = (new EquipmentType())
                    ->setType($type);
                $manager->persist($typeEquipement);
            }
        }

        $climatisations = $typeEquipements["Climatisation"];
        $this->createIntervetion($manager, $climatisations, "Mise en Service", $miseEnService);
        $this->createIntervetion($manager, $climatisations, "Entretien", $entretien);
        $this->createIntervetion($manager, $climatisations, "Depanage", $depanage);
        $this->createIntervetion($manager, $climatisations, "Dépose", $depose);
        $this->createIntervetion($manager, $climatisations, "Repose", $repose);
        $this->createIntervetion($manager, $climatisations, "Dépose Définitive", $deposeDefinitive);
        
        $manager->flush();
    }

    public static function getGroups(): array {
        return ["prod"];
    }
}
