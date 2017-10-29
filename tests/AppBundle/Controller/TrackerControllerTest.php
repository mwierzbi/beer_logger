<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TrackerControllerTest extends WebTestCase
{
    public function testEmptyDataOnIndex()
    {
        $client = static::createClient();
        $url = $client->getContainer()->get('router')->generate('tracker');
        $crawler = $client->request('GET', $url);

        $this->assertTrue($client->getResponse()->isClientError());
    }

    public function testInvalidDataOnIndex()
    {
        $client = static::createClient();
        $param = ['mac' => '', 'value'=>'test'];
        $url = $client->getContainer()->get('router')->generate('tracker', $param);
        $crawler = $client->request('GET', $url, $param);

        $this->assertTrue($client->getResponse()->isClientError());
    }

    public function testValidDataOnIndex()
    {
        $client = static::createClient();
        $param = ['mac' => 'test1', 'value'=>rand(20,60)];
        $url = $client->getContainer()->get('router')->generate('tracker', $param);
        $crawler = $client->request('GET', $url);

        $this->assertTrue($client->getResponse()->isOk());
    }
}
