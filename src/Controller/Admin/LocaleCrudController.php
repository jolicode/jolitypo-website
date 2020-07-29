<?php

namespace App\Controller\Admin;

use App\Entity\Locale;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class LocaleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Locale::class;
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
