<?php

namespace App\Form;

use App\Entity\Employe;
use App\Entity\Entreprise;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EmployeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'attr' => [ 
                    'class' => 'form-control',
                ]
            ])
            // Un tableau des arguments : arguments de ce champ là
            // attr: attributs sur input typetext
            // form-control : bootstrap
            ->add('prenom', TextType::class, [
                'attr' => [ 
                    'class' => 'form-control',
                ]
            ])
            ->add('dateNaissance', DateType::class, [
                'widget' => 'single_text',
                'attr' => [ 
                    'class' => 'form-control',
                ]
            ])
            ->add('dateEmbauche', DateType::class, [
                'widget' => 'single_text',
                'attr' => [ 
                    'class' => 'form-control',
                ]
            ])
            ->add('ville', TextType::class, [
                'required' => false,
                'attr' => [ 
                    'class' => 'form-control'
                ]
            ])
            ->add('entreprise', EntityType::class, [
                'class' => Entreprise::class,
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

    // 'choice_label' => 'raisonSociale' si ne renvoie pas l'information voulue

    // EntityType: nom élément , type champ et tableau d'argument
    //  'class' => Entreprise::class ( indique de quel type son mes objets à l'intérieur de ma liste)
    //  Ce que renvoie par défaut la liste vient du __toString

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employe::class,
        ]);
    }
}
