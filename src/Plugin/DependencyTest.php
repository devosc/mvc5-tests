<?php

namespace Mvc5\Test\Plugin;

use Mvc5\Plugin\Dependency;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class DependencyTest
    extends TestCase
{
    /**
     *
     */
    public function test_name()
    {
        /** @var Dependency|Mock $mock */

        $mock = $this->getCleanMock(Dependency::class, ['name'], ['foo']);

        $this->assertEquals('foo', $mock->name());
    }

    /**
     *
     */
    public function test_config()
    {
        /** @var Dependency|Mock $mock */

        $mock = $this->getCleanMock(Dependency::class, ['config'], [null, 'foo']);

        $this->assertEquals('foo', $mock->config());
    }
}
