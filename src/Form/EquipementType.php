<?php

namespace App\Form;

use App\Entity\Equipement;
use DateTimeImmutable;
use Doctrine\DBAL\Types\DateTimeImmutableType;
use Doctrine\DBAL\Types\DateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EquipementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('installationDate')
            ->add('serialNumber')
            ->add('locationDetail')
            ->add('productType')
            ->add('placementType')
            ->add('remoteNumber')
            ->add('gasWeight')
            ->add('leakDetection')
            ->add('lastLeakDetection')
            ->add('nextLeakControl', DateType::class, [
                'attr' => [
                    'disabled' => true
                ],
                'widget' => 'single_text'
            ])
            ->add('finality')
            ->add('capacity')
            ->add('picto')
            ->add('nfc')
            ->add('location')
            ->add('gas')
            ->add('brand')
            ->add('parent')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Equipement::class,
        ]);
    }
}
