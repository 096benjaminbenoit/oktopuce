<?php

namespace App\Form;

use App\Entity\InterventionQuestion;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AnswerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event): void {

            $data = $event->getData();

            /**
             * @var App\Entity\InterventionQuestion
             */
            $question = $data['question'];

            $form = $event->getForm();
            switch($data['question']->getQuestionType()) {
                case('text'):
                    $form->add('answer', TextType::class, [
                        'label' => $question->getQuestion(),
                        'required' => $question->isRequired(),
                        // 'mapped' => false
                    ]);
                    break;
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
