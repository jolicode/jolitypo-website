<?php

/*
 * This file is part of the JoliTypo Website project.
 * (c) JoliCode <coucou@jolicode.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controller;

use App\Form\TypoFixerType;
use JoliTypo\Fixer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepage(Request $request): Response
    {
        $data = [
            'fixers' => ['Dash', 'Dimension', 'Ellipsis', 'SmartQuotes', 'NoSpaceBeforeComma', 'Hyphen', 'CurlyQuote', 'Trademark', 'Unit'],
        ];

        $form = $this->createForm(TypoFixerType::class, $data);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $fixer = new Fixer($data['fixers']);
            $fixer->setLocale($data['locales']);

            return $this->render('homepage/homepage.html.twig', [
                'form' => $form->createView(),
                'fixedContent' => $fixer->fix($data['content']),
            ]);
        }

        return $this->render('homepage/homepage.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
