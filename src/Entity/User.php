<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['username', 'email'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface {
   #[ORM\Id]
   #[ORM\GeneratedValue]
   #[ORM\Column]
   private ?int $id = null;

   #[ORM\Column( type: 'string', length: 25, unique: true, nullable: false )]
   #[Assert\NotBlank]
   #[Assert\Length( min: 3, max: 25 )]
   private ?string $username = null;

   #[ORM\Column( type: 'string', length: 30, unique: true, nullable: false )]
   #[Assert\NotBlank]
   #[Assert\Email]
   #[Assert\Length( min: 5, max: 30 )]
   private ?string $email = null;

   #[ORM\Column]
   private array $roles = [];

   /**
    * @var string The hashed password
    */
   #[ORM\Column]
   private ?string $password = null;

   #[ORM\Column]
   private \DateTimeImmutable $updatedAt;

   #[ORM\Column( type: 'boolean' )]
   private bool $isVerified = false;

   #[ORM\Column(length: 255, nullable: true)]
   private ?string $googleId = null;

   #[ORM\Column(type: 'string', length: 255, nullable: true)]
   private ?string $hostedDomain;

   #[ORM\Column(nullable: true)]
   private ?bool $isPremium = false;


   public function __construct () {
      $this -> updatedAt = new \DateTimeImmutable();
      $this->roles[] = 'ROLE_USER';
   }

   public function getId () : ?int {
      return $this -> id;
   }

   public function getUsername () : ?string {
      return $this -> username;
   }

   public function setUsername (string $username) : static {
      $this -> username = $username;

      return $this;
   }

   /**
    * A visual identifier that represents this user.
    *
    * @see UserInterface
    */
   public function getUserIdentifier () : string {
      return (string)$this -> username;
   }

   /**
    * @see UserInterface
    */
   public function getRoles () : array {
      return array_unique($this->roles);
   }

   public function setRoles (array $roles) : static {
      $this -> roles = $roles;
      $this->roles = array_unique($this->roles);
      return $this;
   }
   public function addRoles (array $roles) : static {
      foreach ($roles as $role) {
         $this -> roles[] = $role;
      }
      $this->roles = array_unique($this->roles);
      return $this;
   }

   /**
    * @see PasswordAuthenticatedUserInterface
    */
   public function getPassword () : string {
      return $this -> password;
   }

   public function setPassword (string $password) : static {
      $this -> password = $password;

      return $this;
   }

   /**
    * @see UserInterface
    */
   public function eraseCredentials () : void {
      // If you store any temporary, sensitive data on the user, clear it here
      // $this->plainPassword = null;
   }

   public function getEmail () : ?string {
      return $this -> email;
   }

   public function setEmail (?string $email) : void {
      $this -> email = $email;
   }

   public function getUpdatedAt () : \DateTimeImmutable {
      return $this -> updatedAt;
   }

   public function setUpdatedAt (\DateTimeImmutable $updatedAt) : void {
      $this -> updatedAt = $updatedAt;
   }

   public function isVerified () : bool {
      return $this -> isVerified;
   }

   public function setIsVerified (bool $isVerified) : static {
      $this -> isVerified = $isVerified;

      return $this;
   }

   public function getGoogleId(): ?string
   {
       return $this->googleId;
   }

   public function setGoogleId(?string $googleId): static
   {
       $this->googleId = $googleId;

       return $this;
   }

   public function isIsPremium(): ?bool
   {
       return $this->isPremium;
   }

   public function setIsPremium(?bool $isPremium): static
   {
       $this->isPremium = $isPremium;

       return $this;
   }

   public function getHostedDomain () : ?string {
      return $this -> hostedDomain;
   }

   public function setHostedDomain (?string $hostedDomain) : void {
      $this -> hostedDomain = $hostedDomain;
   }
}
