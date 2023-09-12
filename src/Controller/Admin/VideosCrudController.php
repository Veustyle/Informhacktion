<?php

namespace App\Controller\Admin;

use App\Entity\Youtube;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class VideosCrudController extends AbstractCrudController
{
   public static function getEntityFqcn(): string
   {
      return Youtube::class;
   }


   public function configureFields(string $pageName): iterable
   {
      return [
         TextField::new('url'),
         TextField::new('author'),
         TextField::new('category'),
         TextField::new('description')
      ];
   }

}
