<?php

namespace App\Controller\Admin;

use App\Entity\Client;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ClientCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Client::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('un client')
            ->setEntityLabelInPlural('Clients');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('person')->setLabel('Personne'),
            EmailField::new('email'),
            TextField::new('address')->setLabel('Adresse'),
            TextField::new('post_code')->setLabel('Code Postal'),
            TextField::new('city')->setLabel('Ville'),
        ];
    }
}