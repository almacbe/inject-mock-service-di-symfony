<?php

namespace Tests\AppBundle\Controller;

use AppBundle\Service\DeeperServiceInterface;
use AppBundle\Service\Middlware;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;
use Tests\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testSetDiOldWay()
    {
        $options = [
            'test_case' => 'SetDiOldWay',
            'root_config' => __DIR__.'/../../../app/config/config_test.yml'
        ];
        $client = static::createClient($options);

        $deeperService = $this->prophesize(DeeperServiceInterface::class);
        $deeperService->connect()->willReturn(true);
        $deeperService->getResponse()->willReturn('Deeper call');

        $middleware = new Middlware($deeperService->reveal());

        $container = $client->getContainer();
        $container->set('AppBundle\Service\Middlware', $middleware);

        $client->request('GET', '/test-set-di');

        $response = $client->getResponse();
        $this->isSuccessful($response);
        $this->assertContains('Deeper call', $response->getContent());
    }

    /**
     * Añadiendo la definición del servicio en el especifico de este test
     */
    public function testSetDiNewWay()
    {
        $options = array(
            'test_case' => 'SetDiNewWay',
            'root_config' => 'test_services.yml'
        );
        $client = static::createClient($options);

        $container = $client->getContainer();
        try {
            $container->get('test.deeper_service_mock_2');
        } catch (ServiceNotFoundException $exception) {}

        $client->request('GET', '/test-set-di');

        $response = $client->getResponse();
        $this->isSuccessful($response);
        $this->assertContains('Deeper call 1', $response->getContent());
    }

    /**
     * Añadiendo la definición del servicio en el global de servicios
     */
    public function testSetDiNewWay2()
    {
        $options = [
            'test_case' => 'TestSetDiNewWay2',
            'root_config' => __DIR__.'/../../../app/config/config_test.yml',
        ];
        $client = static::createClient($options);
        $container = $client->getContainer();
        $deeperService = $container->get('test.deeper_service_mock_2');
        $deeperService->append(true);
        $deeperService->append('Deeper call 2');

        $client->request('GET', '/test-set-di');

        $response = $client->getResponse();
        $this->isSuccessful($response);
        $this->assertContains('Deeper call 2', $response->getContent());
    }
}
