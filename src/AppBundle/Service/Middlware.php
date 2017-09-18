<?php

namespace AppBundle\Service;

class Middlware implements MiddlwareInterface
{
    /**
     * @var DeeperServiceInterface
     */
    private $deeperService;

    public function __construct(DeeperServiceInterface $deeperService)
    {
        $this->deeperService = $deeperService;
    }

    public function getStringResponse()
    {
        $this->deeperService->connect();

        return $this->deeperService->getResponse();
    }
}
