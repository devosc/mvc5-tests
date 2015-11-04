<?php

namespace Mvc5\Test\Service\Config\ServiceConfig;

use Mvc5\Service\Config\ServiceConfig\ServiceConfig;
use Mvc5\Test\Test\TestCase;

class ServiceConfigTest
    extends TestCase
{
    /**
     *
     */
    public function test_name()
    {
        $mock = $this->getCleanMock(ServiceConfig::class, ['name'], ['foo']);

        $this->assertEquals('foo', $mock->name());
    }
}
