<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('un technicien')
            ->setEntityLabelInPlural('Techniciens');
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TelephoneField::new('phone')->setLabel('Téléphone'),
            AssociationField::new('person')->setLabel('Prénom / Nom'),
            ArrayField::new('roles'),
            TextField::new('password')->setLabel('Mot de passe')->hideOnIndex()
        ];
    }
    
}
