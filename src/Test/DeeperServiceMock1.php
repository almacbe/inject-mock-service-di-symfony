<?php

namespace Test;

use AppBundle\Service\DeeperServiceInterface;

class DeeperServiceMock1 implements DeeperServiceInterface
{
    public function connect()
    {
        return true;
    }

    public function getResponse()
    {
        return 'Deeper call 1';
    }
}
