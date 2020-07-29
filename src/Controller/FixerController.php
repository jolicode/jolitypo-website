<?php

namespace App\Controller;

use http\Client\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FixerController extends AbstractController
{
    public function new(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('locale', ChoiceType::class)
            ->add('fixers', DateType::class)
            ->add('toFixContent', SubmitType::class, ['label' => 'Create Task'])
            ->add('submit', SubmitType::class)
            ->getForm();
    }
}
