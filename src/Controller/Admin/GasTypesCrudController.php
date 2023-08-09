<?php

namespace App\Controller\Admin;

use App\Entity\GasTypes;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class GasTypesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return GasTypes::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('un gaz')
            ->setEntityLabelInPlural('Gaz');
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
