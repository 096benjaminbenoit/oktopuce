<?php

namespace App\Controller\Admin;

use App\Entity\Brand;
use App\Form\AnswerType;
use App\Entity\Intervention;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Intl\Scripts;
use App\Entity\InterventionQuestion;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use App\Repository\InterventionTypeRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Symfony\Component\Console\Question\Question;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Config\KeyValueStore;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use App\Controller\Admin\InterventionQuestionCrudController;
use App\Entity\Equipment;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Form\ChoiceList\Factory\Cache\ChoiceFieldName;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class InterventionCrudController extends AbstractCrudController
{
    public function __construct(private InterventionTypeRepository $interventionTypeRepository)
    {
        
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions

        ->add(Crud::PAGE_INDEX, Action::DETAIL)
        ;
    }

    public function configureAssets(Assets $assets): Assets
    {
        return $assets
            ->addWebpackEncoreEntry('admin-app')
        ;
    }

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
            AssociationField::new('equipment')->setLabel('N° de série'),
            // AssociationField::new('person')->setLabel('Prénom / Nom'),
            TextField::new('technician')->setRequired(true),
            TextField::new('enterprise'),
            DateField::new('interventionDate')->setLabel('Date de l\'intervention'),
            AssociationField::new('interventionType')
                ->setFormTypeOptions(['attr' => [
                    'data-controller' => 'intervention',
                    'data-action' => "change->intervention#onChange",
                ]])
                ->setFormTypeOption('choice_name', 'id'),
            // DependentField::adapt(
            //     AssociationField::new('person'),
            //     [
            //         'callback_url' => $this->generateUrl('app_admin_api_interventions', [], UrlGeneratorInterface::ABSOLUTE_URL),
            //         'dependencies' => ['interventionTypes'],
            //         'fetch_on_init' => false
            //     ]
            // )
        ];
    }

    public function createNewForm(EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context): FormInterface
    {
        $builder = parent::createNewFormBuilder($entityDto, $formOptions, $context);
        $builder = self::formBuilderModifier($builder);
        return $builder->getForm();
    }

    public function createEditForm(EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context): FormInterface
    {
        $builder = parent::createEditFormBuilder($entityDto, $formOptions, $context);
        $builder = self::formBuilderModifier($builder);
        return $builder->getForm();
    }

    public function formBuilderModifier($builder)
    {
        $builder->addEventListener(
            FormEvents::POST_SET_DATA,
            function (FormEvent $event) {
                $data = $event->getData();
                $interventionType = $data->getInterventionType();

                if(empty($interventionType)) {
                    $interventionType = $this->interventionTypeRepository->findAll()[0];
                }

                if(empty($event->getData()->getAnswers()) ||$event->getData()->getAnswers()[0]['question']['intervention_type'] != $interventionType->getId()) {
                    $answers = $interventionType->getQuestions()->toArray();

                    $answers = array_map(function(InterventionQuestion $question,) {
                        return [
                            'question' => [
                                'id' => $question->getId(),
                                'type' => $question->getQuestionType(),
                                'label' => $question->getQuestion(),
                                'choices' => $question->getChoices(),
                                'required' => $question->isRequired(),
                                'intervention_type' => $question->getInterventionType()->getId(),
                                // "prochaine_detection_de_fuite" => $equipment->getNextLeakDetection(),
                            ],
                            'answer' => ''
                        ];
                    }, $answers);
                    $data->setAnswers($answers);
                    $event->setData($data);
                }
              

                $event->getForm()->add('answers', CollectionType::class, [
                    'label' => false,
                    'entry_type' => AnswerType::class,
                    'required' => true,
                ]);
            }
        );

        return $builder;
    }
}
