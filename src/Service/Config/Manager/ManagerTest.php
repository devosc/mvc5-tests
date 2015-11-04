<?php

namespace Mvc5\Test\Service\Config\Manager;

use Mvc5\Service\Config\Manager\Manager;
use Mvc5\Test\Test\TestCase;

class ManagerTest
    extends TestCase
{
    /**
     *
     */
    public function test__construct()
    {
        $this->assertInstanceOf(Manager::class, new Manager('foo'));
    }
}
