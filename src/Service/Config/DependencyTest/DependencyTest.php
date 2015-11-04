<?php

namespace Mvc5\Test\Service\Config\Dependency;

use Mvc5\Service\Config\Dependency\Dependency;
use Mvc5\Test\Test\TestCase;

class DependencyTest
    extends TestCase
{
    /**
     *
     */
    public function test_name()
    {
        $mock = $this->getCleanMock(Dependency::class, ['name'], ['foo']);

        $this->assertEquals('foo', $mock->name());
    }
}
