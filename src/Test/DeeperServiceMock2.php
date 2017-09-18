<?php

namespace Test;

use AppBundle\Service\DeeperService;

class DeeperServiceMock2 extends DeeperService
{
    private static $calls = -1;

    private $response;

    public function __construct()
    {
        $this->response = [];
    }

    public function connect()
    {
        return $this->response[++self::$calls];
    }

    public function getResponse()
    {
        return $this->response[++self::$calls];
    }

    public function append($response)
    {
        array_push($this->response, $response);
    }
}
