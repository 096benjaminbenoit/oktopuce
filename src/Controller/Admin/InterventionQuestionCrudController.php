<?php

namespace App\Controller\Admin;

use App\Entity\InterventionQuestion;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use App\Field\JsonArrayField; // Import the custom JsonArrayField
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class InterventionQuestionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return InterventionQuestion::class;
    }
    
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Question Intervention')
            ->setEntityLabelInPlural('Questions Intervention');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            // Display the 'question' field as an ArrayField
            TextField::new('question'),
            ChoiceField::new('questionType')->setChoices([
                "Champs libre" => "text",
                "Choix multiple" => "multiple",
                "Choix unique"   => "select",
                "Case à cocher"  => "checkbox",
            ])->setLabel("Type de question")->setRequired(true),
            ArrayField::new('choices'),
            BooleanField::new('required'),

        ];
    }
}
