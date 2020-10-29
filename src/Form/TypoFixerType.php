<?php

/*
 * This file is part of the JoliTypo Website project.
 * (c) JoliCode <coucou@jolicode.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\LocaleType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\Count;
use Symfony\Component\Validator\Constraints\Locale;
use Symfony\Component\Validator\Constraints\NotNull;

class TypoFixerType extends AbstractType
{
    /**
     * Contains the available fixes.
     * To know more about fixes, see : https://github.com/jolicode/JoliTypo.
     */
    private const FIXER_FIXES = [
        'Dash' => 'Add longer dashes instead of regular ones',
        'Dimension' => 'Real × symbol between numbers',
        'Ellipsis' => 'Real ellipsis rather than three dots',
        'SmartQuotes' => 'Langage adequate quotes',
        'FrenchNoBreakSpace' => 'Set non breaking spaces before : ; ! ?',
        'NoSpaceBeforeComma' => 'Remove spaces before commas',
        'Hyphen' => 'Automatic word-hyphenation',
        'CurlyQuote' => 'Replace straight quotes by curly one’s',
        'Trademark' => 'Handle symbols like ™ © ®',
        'Numeric' => 'Add non breaking spaces for units',
    ];

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('locales', LocaleType::class, [
            'placeholder' => 'Select a locale',
            'label' => false,
            'preferred_choices' => ['fr', 'en', 'de', 'es', 'it'],
            'constraints' => [new NotNull()]
        ]);

        $builder->add('fixers', ChoiceType::class, [
            'choices' => array_flip(self::FIXER_FIXES),
            'multiple' => true,
            'expanded' => true,
            'constraints' => [
                new Count([
                    'min' => 1,
                    'minMessage' => 'It seems you are trying to fix without fixers. Did you forget to apply fixers ?'
                ])
            ],
        ]);

        $builder->add('content', TextareaType::class, [
            'label' => false,
            'constraints' => [
                new NotNull([
                    'message' => 'Unfortunately, we can\'t fix what doesn\'t exist ! Please enter something to fix.',
                ]),
            ],
        ]);
    }
}
