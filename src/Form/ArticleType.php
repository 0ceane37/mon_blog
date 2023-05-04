<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Titre de l\'article',
                'attr' => [
                    'placeholder' => 'Les Ours'
                ]
            ])
            ->add('picture', TextType::class, [
                'label' => 'L\'Url de l\'image',
                'attr' => [
                    'placeholder' => 'https://i.pinimg.com/564x/7e/5f/43/7e5f43a9f9aea0a4479e0044021652c1.jpg'
                ]
            ])
            ->add('sousTitre', TextType::class, [
                'label' => 'Sous-titre de l\'article',
                'attr' => [
                    'placeholder' => 'La vie des Ours'
                ]
            ])
            ->add('content', TextType::class, [
                'label' => 'Contenu de l\'article',
                'attr' => [
                    'placeholder' => 'Les ours sont des mammifères de la famille des ursidés...'
                ]
            ])
            ->add('conclusion', TextType::class, [
                'label' => 'La conclusion de l\'article',
                'attr' => [
                    'placeholder' => 'Les ours sont des animaux fascinants qui sont présents dans de nombreuses régions du monde...'
                ]
            ])
            ->add('date',DateTimeType::class)
            ->add('Envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
