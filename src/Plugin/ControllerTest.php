<?php

namespace Mvc5\Test\Plugin;

use Mvc5\Plugin\Controller;
use Mvc5\Test\Test\TestCase;

class ControllerTest
    extends TestCase
{
    /**
     *
     */
    public function test_construct()
    {
        $this->assertInstanceOf(Controller::class, new Controller('foo'));
    }
}
