<?php

namespace BabysittingBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BabysittingControllerTest extends WebTestCase
{
    public function testAjouterbabysitting()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ajouterBabysitting');
    }

    public function testModifierbabysitting()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/modifierBabysitting');
    }

    public function testListermesbabysittings()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/listerMesBabysittings');
    }

    public function testListerdesbabysittings()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/listerDesBabysittings');
    }

    public function testHistoriquebabysitting()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/historiqueBabysitting');
    }

    public function testChercherbabysitting()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/chercherBabysitting');
    }

    public function testDistancebabysitting()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/distanceBabysitting');
    }

}
