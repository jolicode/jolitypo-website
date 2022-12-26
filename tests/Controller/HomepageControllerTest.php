<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomepageControllerTest extends WebTestCase
{
    public function testHomepage()
    {
        $client = static::createClient();
        $client->request('GET', '/');
        $response = $client->getResponse();

        self::assertSame(200, $response->getStatusCode(), $response->getContent());
    }

    public function testSubmitWorks()
    {
        $client = static::createClient();
        $client->request('GET', '/');
        $crawler = $client->submitForm('submit', [
            'typo_fixer' => [
                'locales' => 'af',
                'fixers' => ['Dash'],
                'content' => 'Hello Damien !',
            ]
        ]);
        $response = $client->getResponse();

        self::assertSame(200, $response->getStatusCode(), $response->getContent());
        self::assertSame(1, $crawler->filter('textarea.form__result-client')->count());
        self::assertSame(1, $crawler->filter('textarea.form__result-html')->count());
    }

    public function testEmptyLocaleBreaks()
    {
        $client = static::createClient();
        $client->request('GET', '/');
        $crawler = $client->submitForm('submit', [
            'typo_fixer' => [
                'locales' => '',
                'fixers' => ['Dash'],
                'content' => 'Hello Damien !',
            ]
        ]);
        $response = $client->getResponse();

        self::assertSame(200, $response->getStatusCode(), $response->getContent());
        self::assertSame(0, $crawler->filter('textarea.form__result-client')->count());
        self::assertSame(0, $crawler->filter('textarea.form__result-html')->count());
        self::assertSame(1, $crawler->filter('html div.error-message', 'This value should not be null.')->count());
    }

    public function testEmptyContentBreaks()
    {
        $client = static::createClient();
        $client->request('GET', '/');
        $crawler = $client->submitForm('submit', [
            'typo_fixer' => [
                'locales' => 'af',
                'fixers' => ['Dash'],
                'content' => '',
            ]
        ]);
        $response = $client->getResponse();

        self::assertSame(200, $response->getStatusCode(), $response->getContent());
        self::assertSame(0, $crawler->filter('textarea.form__result-client')->count());
        self::assertSame(0, $crawler->filter('textarea.form__result-html')->count());
        self::assertSame(1, $crawler->filter('html div.error-message', 'Unfortunately, we can\'t fix what doesn\'t exist ! Please enter something to fix.')->count());
    }
}
