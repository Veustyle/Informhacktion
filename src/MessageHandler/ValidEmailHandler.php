<?php

namespace App\MessageHandler;

use App\Message\ValidEmail;
use App\Repository\UserRepository;
use App\Security\EmailVerifier;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

#[AsMessageHandler]
class ValidEmailHandler {

   public function __construct (private readonly EmailVerifier $emailVerifier, private readonly UserRepository $repository, private readonly UrlGeneratorInterface $urlGenerator) {}

   public function __invoke (ValidEmail $validEmail) : void {
      $user = $this->repository->findOneBy(['id' => $validEmail->getUserID()]);

      $this->emailVerifier->sendEmailConfirmation($this->urlGenerator('email.verify'), $user, (new TemplatedEmail())
            ->from(new Address('sd_developper@informhacktion.com', 'Admin'))
            ->to($user->getEmail())
            ->subject('Confirmation adresse e-mail')
            ->htmlTemplate('registration/confirmation_email.html.twig')
      );
   }
}