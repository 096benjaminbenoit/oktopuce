<?php

namespace App\Controller\Admin;

use App\Entity\Site;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SiteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Site::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('un site')
            ->setEntityLabelInPlural('Sites');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('address')->setLabel('Adresse'),
            TextField::new('city')->setLabel('Ville'),
            TextField::new('postcode')->setLabel('Code postal'),
            TextField::new('name')->setLabel('Nom'),
            AssociationField::new('client')
        ];
    }
}
