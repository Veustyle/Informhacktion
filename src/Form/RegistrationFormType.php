<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
   public function __construct(private readonly UrlGeneratorInterface $urlGenerator) {

   }
   public function buildForm(FormBuilderInterface $builder, array $options): void
   {
      $builder
         ->setAction($this->urlGenerator->generate('home'))
         ->setMethod('get')
         ->add('username', TextType::class, [
            'attr' => [
               'class' => 'form-fields'
            ],
            'label' => 'Nom d\'utilisateur',
            'label_attr' => [
               'class' => 'form-labels'
            ],
         ])
         ->add('email', EmailType::class, [
            'attr' => [
               'class' => 'form-fields'
            ],
            'label' => 'Adresse e-mail',
            'label_attr' => [
               'class' => 'form-labels'
            ]
         ])
         ->add('agreeTerms', CheckboxType::class, [
            'label' =>'Conditions d\'utilisation',
            'label_attr' => [
               'class' => 'form-labels'
            ],
            'mapped' => false,
            'constraints' => [
               new IsTrue([
                  'message' => 'Vous devez accepter les conditions',
               ]),
            ],
         ])
         ->add('plainPassword', PasswordType::class, [
            'attr' => [
               'autocomplete' => 'new-password',
               'class' => 'form-fields'
            ],
            'label' => 'Mot de passe',
            'label_attr' => [
               'class' => 'form-labels'
            ],
            'mapped' => false,
            'constraints' => [
               new NotBlank([
                  'message' => 'Veuillez entrer un mot de passe',
               ]),
               new Length([
                  'min' => 6,
                  'minMessage' => 'Le mot de passe ne doit pas dépasser {{ limit }} caractères',
                  'max' => 4096,
               ]),
            ],
         ])
      ;
   }

   public function configureOptions(OptionsResolver $resolver): void
   {
      $resolver->setDefaults([
         'data_class' => User::class,
         'constraints' => [
            new UniqueEntity(['fields' => 'email']),
            new UniqueEntity(['fields' => 'username']),
         ],
      ]);
   }
}