<?php

namespace App\Form;

use App\Entity\CannabisProduct;
use App\Entity\CannabisProductRating;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CannabisProductRatingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quality', IntegerType::class, [
                'label' => 'Quality',
                'attr' => [
                    'min' => 1,
                    'max' => 5,
                ]
            ])
            ->add('effect', IntegerType::class, [
                'label' => 'Effect',
                'attr' => [
                    'min' => 1,
                    'max' => 5,
                ]
            ])
            ->add('safety', IntegerType::class, [
                'label' => 'Safety',
                'attr' => [
                    'min' => 1,
                    'max' => 5,
                ]
            ])
            ->add('reliability', IntegerType::class, [
                'label' => 'Reliability',
                'attr' => [
                    'min' => 1,
                    'max' => 5,
                ]
            ])
            ->add('pricePerformance', IntegerType::class, [
                'label' => 'Price Performance',
                'attr' => [
                    'min' => 1,
                    'max' => 5,
                ]
            ])
            ->add('trust', IntegerType::class, [
                'label' => 'Trust',
                'attr' => [
                    'min' => 1,
                    'max' => 5,
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Submit Rating',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CannabisProductRating::class,
        ]);
    }
}
