<?php

namespace App\Controller;

use App\Entity\Fixer;
use App\Entity\Locale;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Count;
use Symfony\Component\Validator\Constraints\NotBlank;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request, EntityManagerInterface $em)
    {
        $fixedContent = '';
        $toFixContent = '';

        $form = $this->createFormBuilder(['Fixer'])
            ->add('locales', EntityType::class, [
                'class' => Locale::class,
                'choice_label' => 'name',
            ])
            ->add('fixers', EntityType::class, [
                'class' => Fixer::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'constraints' => new Count(['min' => 1, 'minMessage' => 'You should select at least one fixer']),
            ])
            ->add('toFixContent', TextareaType::class, [
                'constraints' => new NotBlank(),
                'label' => false,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Try',
            ])
            ->getForm();

        if ($request->isMethod('POST')) {
            $form->submit($request->request->get($form->getName()));

            if ($form->isSubmitted() && $form->isValid()) {
                $toFixContent = $form->getData()['toFixContent'];
                $fixers = $form->getData()['fixers']->map(function (Fixer $fixer) {
                    return $fixer->getName();
                })->toArray();
                $fixer = new \JoliTypo\Fixer($fixers);
                $fixer->setLocale($form->getData()['locales']->getName());
                $fixedContent = $fixer->fix($toFixContent);
            }
        }

        $fixers = $em->getRepository(Fixer::class)->findAllSortedByName();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'form' => $form->createView(),
            'fixedContent' => $fixedContent,
            'toFixContent' => $toFixContent,
            'fixers' => $fixers,
            'jolitypo_lib_link' => 'https://github.com/jolicode/JoliTypo',
        ]);
    }
}
