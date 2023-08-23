<?php

namespace App\Controller\Admin;

use App\Entity\EquipmentType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EquipmentTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return EquipmentType::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular("type d'équipement")
            ->setEntityLabelInPlural("Types d'équipements");
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('type')->setLabel("Nom du type d'équipement"),
            
            
        ];
    }
}
