<?php

namespace App\Controller\Admin;

use App\Entity\Fixer;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class FixerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Fixer::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
