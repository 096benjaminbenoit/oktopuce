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
            ->setEntityLabelInPlural('Equipements');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('nfc')->setLabel('Id de la puce'),
            TextField::new('product_type')->setLabel('Type de produit'),
            AssociationField::new('brand')->setLabel('Marque'),
            AssociationField::new('location')->setLabel('Emplacement'),
            TextField::new('location_detail')->setLabel('Detail de l\'emplacement')->hideOnIndex(),
            AssociationField::new('gas')->setLabel('Type de gaz'),
            AssociationField::new('parent')->hideOnIndex(),
            DateField::new('installation_date')->setLabel('Date d\'installation')->setFormat('short'),
            TextField::new('serial_number')->setLabel('N° de série'),
            TextField::new('placement_type')->setLabel('Type de pose'),
            TextField::new('remote_number')->setLabel('N° de télécomande')->hideOnIndex(),
            NumberField::new('gas_weight')->setLabel('Poids du gaz')->hideOnIndex(),
            BooleanField::new('leak_detection')->setLabel('Détection des fuites'),
            DateField::new('next_leak_control')->setLabel('Prochain contrôle de fuite')->setFormat('short'),
            // CollectionField::new('finality'),
            NumberField::new('capacity')->setLabel('Capacité')->hideOnIndex(),
            TextField::new('picto')->setLabel('Pictogramme')->hideOnIndex()
        ];
    }
}
