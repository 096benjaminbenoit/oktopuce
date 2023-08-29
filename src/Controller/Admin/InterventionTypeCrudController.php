<?php

namespace App\Controller\Admin;

use App\Entity\InterventionType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use App\Controller\Admin\EquipmentTypeCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class InterventionTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return InterventionType::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('un type d\'intervention')
            ->setEntityLabelInPlural('Types d\'interventions');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('type'),
            CollectionField::new('questions')
                ->useEntryCrudForm(InterventionQuestionCrudController::class)
            ,
            AssociationField::new('equipmentTypes'),
    ];
    }
}
