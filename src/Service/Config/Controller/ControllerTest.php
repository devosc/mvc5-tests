<?php

namespace Mvc5\Test\Service\Config\Controller;

use Mvc5\Service\Config\Controller\Controller;
use Mvc5\Test\Test\TestCase;

class ControllerTest
    extends TestCase
{
    /**
     *
     */
    public function test__construct()
    {
        $this->assertInstanceOf(Controller::class, new Controller('foo'));
    }
}
