<?php

namespace Tests\AppBundle\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testLifeInMars()
    {
        $client = static::createClient();

        $client->request('GET', '/test-set-di');

        $response = $client->getResponse();
        $this->isSuccessful($response);
        $this->assertContains('There is life in Mars', $response->getContent());
    }
}
