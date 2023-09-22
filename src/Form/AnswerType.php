<?php

namespace App\Form;

use App\Entity\InterventionQuestion;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class AnswerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event): void {

            $data = $event->getData();

            $question = $data['question'];

            $form = $event->getForm();
            switch($question['type']) {
                case('text'):
                    $form->add('answer', TextType::class, [
                        'label' => $question['label'],
                        'required' => $question['required'],
                        // 'mapped' => false
                    ]);
                    break;
                case('select'):
                    $form->add('answer', ChoiceType::class, [
                        'label' => $question['label'],
                        'required' => $question['required'],
                        'choices' => $question['choices'],
                        'choice_label' => function ($choice, string $key, mixed $value) {
                            return $value;
                        },
                    ]);
                    break;
                case('checkbox'):
                    $form->add('answer', CheckboxType::class, [
                        'label' => $question['label'],
                        'required' => false,
                        // 'choices' => $question['choices'],
                        // 'choice_label' => function ($choice, string $key, mixed $value) {
                        //     return $value;
                        // },
                    ]);
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
