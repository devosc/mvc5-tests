<?php

namespace Mvc5\Test\Service\Config\ControllerAction;

use Mvc5\Service\Config\ControllerAction\ControllerAction;
use Mvc5\Test\Test\TestCase;

class ControllerActionTest
    extends TestCase
{
    /**
     *
     */
    public function test__construct()
    {
        $this->assertInstanceOf(ControllerAction::class, new ControllerAction);
    }
}
