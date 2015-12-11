<?php

namespace Mvc5\Test\Plugin;

use Mvc5\Plugin\Plug;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class ServiceConfigTest
    extends TestCase
{
    /**
     *
     */
    public function test_name()
    {
        /** @var Plug|Mock $mock */

        $mock = $this->getCleanMock(Plug::class, ['name'], ['foo']);

        $this->assertEquals('foo', $mock->name());
    }
}
