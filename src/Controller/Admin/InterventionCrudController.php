<?php

namespace App\Controller\Admin;

use App\Entity\Intervention;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Symfony\Component\Form\ChoiceList\Factory\Cache\ChoiceFieldName;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

class InterventionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Intervention::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('une intervention')
            ->setEntityLabelInPlural('Interventions');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('equipement')->setLabel('N° de série'),
            AssociationField::new('person')->setLabel('Prénom / Nom'),
            TextField::new('technicien'),
            TextField::new('entreprise'),
            ArrayField::new('type'),
            DateTimeField::new('interventionDate')->setLabel('Date de l\'intervention')
        ];
    }
}
