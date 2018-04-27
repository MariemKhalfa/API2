<?php

namespace CovoiturageBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CovoiturageControllerTest extends WebTestCase
{
    public function testAjoutercov()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ajouterCov');
    }

    public function testModifiercov()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/modifierCov');
    }

    public function testListermescov()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/listerMesCov');
    }

    public function testListerdescov()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/listerDesCov');
    }

    public function testHistoriquecov()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/historiqueCov');
    }

    public function testCherchercov()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/chercherCov');
    }

    public function testMatchingcov()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/matchingCov');
    }

    public function testDistancecov()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/distanceCov');
    }

}
