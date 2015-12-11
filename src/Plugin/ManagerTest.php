<?php

namespace Mvc5\Test\Plugin;

use Mvc5\Plugin\Manager;
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
