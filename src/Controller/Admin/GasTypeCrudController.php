<?php

namespace App\Controller\Admin;

use App\Entity\GasType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class GasTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return GasType::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('un gaz')
            ->setEntityLabelInPlural('Gaz');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')->setLabel('Nom du gaz'),
            NumberField::new('eq_co2_per_kg')->setLabel('Equivalent CO2 par kg'),
        ];
    }
}
