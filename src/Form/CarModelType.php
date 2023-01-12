<?php

namespace App\Form;

use App\Entity\CarModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



class CarModelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('brand', TextType::class)
            ->add('year', IntegerType::class)
            ->add('energy', TextType::class)
            ->add('model', TextType::class)
            ->add('description', TextareaType::class,)
            ->add('picture', TextType::class)
            ->add('category', TextType::class)
            ->add('seats', IntegerType::class)
            ->add('bootVolume', IntegerType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CarModel::class,
        ]);
    }
}
