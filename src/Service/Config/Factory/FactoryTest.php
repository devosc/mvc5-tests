<?php

namespace Mvc5\Test\Service\Config\Factory;

use Mvc5\Service\Config\Factory\Factory;
use Mvc5\Test\Test\TestCase;

class FactoryTest
    extends TestCase
{
    /**
     *
     */
    public function test__construct()
    {
        $this->assertInstanceOf(Factory::class, new Factory('foo'));
    }
}
