<?php

namespace App\Controller\Admin;

use App\Entity\NfcTag;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class NfcTagCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return NfcTag::class;
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
