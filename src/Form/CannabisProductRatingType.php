<?php

namespace App\Form;

use App\Entity\CannabisProduct;
use App\Entity\CannabisProductRating;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CannabisProductRatingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quality')
            ->add('effect')
            ->add('safety')
            ->add('reliability')
            ->add('pricePerformance')
            ->add('trust')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CannabisProductRating::class,
        ]);
    }
}
