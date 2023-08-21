<?php

namespace App\Controller\Admin;

use App\Entity\NfcTag;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class NfcTagCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return NfcTag::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('une puce NFC')
            ->setEntityLabelInPlural('Puces NFC');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('uid')->setLabel('N° de la puce'),
        ];
    }
}
