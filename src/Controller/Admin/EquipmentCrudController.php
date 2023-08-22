<?php

namespace App\Controller\Admin;

use App\Entity\Equipment;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use PhpParser\Node\Expr\Cast\Bool_;

class EquipmentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Equipment::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('un équipement')
            ->setEntityLabelInPlural('equipments');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('nfcTag')->setLabel('Id de la puce'),
            AssociationField::new('equipmentType')->setLabel('Type de produit'),
            AssociationField::new('brand')->setLabel('Marque'),
            AssociationField::new('location')->setLabel('Emplacement'),
            TextField::new('locationDetail')->setLabel('Detail de l\'emplacement')->hideOnIndex(),
            AssociationField::new('gas')->setLabel('Type de gaz'),
            AssociationField::new('parent')->setRequired(false)->hideOnIndex(),
            DateField::new('installationDate')->setLabel('Date d\'installation')->setFormat('short'),
            TextField::new('serialNumber')->setLabel('N° de série'),
            AssociationField::new('placement')->setLabel('Type de pose')->setRequired("bool"),
            TextField::new('remoteNumber')->setLabel('N° de télécomande')->hideOnIndex(),
            NumberField::new('gasWeight')->setLabel('Poids du gaz')->hideOnIndex(),
            BooleanField::new('HasleakDetection')->setLabel('Détection des fuites'),
            DateField::new('nextLeakDetection')->setLabel('Prochain contrôle de fuite')->setFormat('short'),
            // CollectionField::new('finality'),
            NumberField::new('capacity')->setLabel('Capacité')->hideOnIndex(),
            TextField::new('picto')->setLabel('Pictogramme')->hideOnIndex()
        ];
    }
}
