<?php

namespace App\EventSubscriber;

use App\Form\RegistrationFormType;
use App\Service\Compteur;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Twig\Environment;

class EventCompteur implements EventSubscriberInterface
{
   public function __construct (private readonly Compteur $compteur, private readonly Environment $twig, private readonly FormFactoryInterface $factory)
   {}

   public static function getSubscribedEvents(): array
   {
      return [
         KernelEvents::REQUEST => [
            ['compteur'], ['registerForm']
         ]
      ];
   }

   public function compteur(): void
   {
      $this->compteur->incrementer();
      $this->twig->addGlobal('compteur', $this->compteur->recuperer());
   }

   public function registerForm(): void
   {
      $form = $this ->factory->create(RegistrationFormType::class);
      $this->twig->addGlobal('registrationForm', $form->createView());
   }
}