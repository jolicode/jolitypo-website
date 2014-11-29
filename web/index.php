<?php

include "../vendor/autoload.php";


use JoliTypo\Fixer;

$fixer = new Fixer(array('Ellipsis', 'Dash', 'EnglishQuotes', 'CurlyQuote', 'Hyphen'));
$fixed_content = $fixer->fix('<p>"Tell me Mr. Anderson... what good is a phone call... if you\'re unable to speak?" -- Agent Smith, <em>Matrix</em>.</p>');

echo $fixed_content;
