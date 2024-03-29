<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
   public static function getEntityFqcn(): string
   {
      return User::class;
   }


   public function configureFields(string $pageName): iterable
   {
      return [
         TextField::new('username'),
         TextField::new('email'),
         ArrayField::new('roles'),
         BooleanField::new(propertyName: 'isVerified'),
         BooleanField::new(propertyName: 'isPremium'),
         DateTimeField::new(propertyName: 'updatedAt')->hideOnIndex(),
      ];
   }

}
