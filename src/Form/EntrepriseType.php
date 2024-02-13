<?php

namespace App\Form;

use App\Entity\Entreprise;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EntrepriseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('raisonSociale', TextType::class, [
                'attr' => [ 
                    'class' => 'form-control'
                ]
            ])
            ->add('dateCreation', DateType::class, [
                'widget' => 'single_text',
                'attr' => [ 
                    'class' => 'form-control',
                ]
            ])
            // widget 'single_text': présenté sous forme de champ texte simple dans le formulaire
            // 'class' => 'form-control': stylé avec la classe CSS 'form-control' (bootsrap) 
            
            ->add('adresse', TextType::class, [
                'attr' => [ 
                    'class' => 'form-control'
                ]
            ])
            ->add('cp', TextType::class, [
                'attr' => [ 
                    'class' => 'form-control'
                ]
            ])
            ->add('ville', TextType::class, [
                'attr' => [ 
                    'class' => 'form-control'
                ]
            ])
            ->add('valider', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-success'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Entreprise::class,
        ]);
    }
}