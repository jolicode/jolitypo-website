<?php

namespace App\DataFixtures;

use App\Entity\Fixer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FixerFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $localesName = ['Dash', 'Dimension', 'Ellipsis', 'SmartQuotes', 'FrenchNoBreakSpace', 'NoSpaceBeforeComma', 'Hyphen (automatic hyphenation)', 'CurlyQuote (Smart Quote)', 'Trademark', 'Unit (formerly Numeric)'];
        $localesDescription = ['Replace the simple - by a ndash – between numbers (dates ranges...) and the double -- by a mdash —.', 'Replace the letter x between numbers (12 x 123) by a times entity (×, the real math symbol).', 'Replace the three dot ... by an ellipsis ….', 'Convert dumb quotes " " to all kind of smart style quotation marks (“ ”, « », „ “...). Handle a good variety of locales, like English, Arabic, French, Italian, Spanish, Irish, German...

See the code for more details, and do not forget to specify a locale on the Fixer instance.

This Fixer replace legacy EnglishQuotes, FrenchQuotes and GermanQuotes.', 'Replace some classic spaces by non breaking spaces following the French typographic code. No break space are placed before :, thin no break space before ;, ! and ?.', 'Remove space before , and make sure there is only one space after.', 'Make use of org_heigl/hyphenator, a tool enabling word-hyphenation in PHP. This Hyphenator uses the pattern-files from OpenOffice which are based on the pattern-files created for TeX.

There is only some locale available for this fixer: af_ZA, ca, da_DK, de_AT, de_CH, de_DE, en_GB, en_UK, et_EE, fr, hr_HR, hu_HU, it_IT, lt_LT, nb_NO, nn_NO, nl_NL, pl_PL, pt_BR, ro_RO, ru_RU, sk_SK, sl_SI, sr, zu_ZA.

You can read more about this fixer on the official github repository.

This Fixer require a Locale to be set on the Fixer with $fixer->setLocale(\'fr_FR\');. Default to en_GB.

Proper hyphenation is mandatory in justified text and you should avoid word breaking in titles with this line of CSS: hyphens:none;.', 'Replace straight quotes \' by curly one\'s ’. There is on exception to consider: foot and inch marks (minutes and second marks). Purists use prime ′, this fixer use straight quote for compatibility. Read more about Curly quotes.', 'Handle trade­mark symbol ™, a reg­is­tered trade­mark symbol ®, and a copy­right symbol ©. This fixer replace commonly used approximations: (r), (c) and (TM). A non-breaking space is put between numbers and copyright symbol too.', 'Add a non-breaking space between a numeric and it\'s unit. Like this: 12_h, 42_฿ or 88_%. It was named Numeric before release 1.0.2, but BC is kept for now.

It is really easy to make your own Fixers, feel free to extend the provided ones if they do not fit your typographic rules.'];

        for ($i = 0; $i < count($localesName); ++$i) {
            $fixer = new Fixer();
            $fixer->setName(\JoliTypo\Fixer::getLanguageFromLocale($localesName[$i]));
            $fixer->setDescription($localesDescription[$i]);
            $manager->persist($fixer);
        }

        $manager->flush();
    }
}
