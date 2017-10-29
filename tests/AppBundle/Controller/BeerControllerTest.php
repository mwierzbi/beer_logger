<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Routing\Router;

class BeerControllerTest extends WebTestCase
{

    public function testAddBeer()
    {
        $client = static::createClient();
        /** @var Router $router */
        $router = $client->getContainer()->get('router');

        $crawler = $client->request('GET', $router->generate('addBeer'));

        $this->assertTrue($client->getResponse()->isSuccessful());

        $form = $crawler->selectButton('Save')->form();
        $form['beer[name]'] = 'TestBeer';
        $crawler = $client->submit($form);
//
        $this->assertTrue($client->getResponse()->isSuccessful());
    }
}
