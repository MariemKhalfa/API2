<?php

namespace CovoiturageBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class VoitureControllerTest extends WebTestCase
{
    public function testAjoutvoiture()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ajoutVoiture');
    }

    public function testDetailvoiture()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/detailVoiture');
    }

    public function testSupprimervoiture()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/supprimerVoiture');
    }

    public function testModifiervoiture()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/modifierVoiture');
    }

}
