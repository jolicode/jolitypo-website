<?php

namespace App\DataFixtures;

use App\Entity\Locale;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LocaleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $localesName = ['en_GB', 'fr_FR', 'fr_CA', 'de_DE'];
        $localesDescription = ['English from Grait Britain', 'Those rules apply most of the recommendations of "Abrégé du code typographique à l\'usage de la presse", ISBN: 9782351130667.', 'Mostly the same as fr_FR, but the space before punctuation points is not mandatory.', 'Mostly the same as en_GB, according to Typefacts and Wikipedia.'];

        for ($i = 0; $i < count($localesName); ++$i) {
            $locale = new Locale();
            $locale->setName($localesName[$i]);
            $locale->setDescription($localesDescription[$i]);
            $manager->persist($locale);
        }

        $manager->flush();
    }
}
