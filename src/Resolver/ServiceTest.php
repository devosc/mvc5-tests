<?php
/**
 *
 */

namespace Mvc5\Test\Resolver;

use Mvc5\Resolver\Service;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class ServiceTest
    extends TestCase
{
    /**
     *
     */
    public function test_construct()
    {
        new Service([]);
    }

    /**
     *
     */
    public function test_invoke()
    {
        /** @var Service $mock */

        $mock = $this->getCleanMock(Service::class, ['__invoke']);

        $this->assertEquals(null, $mock->__invoke('foo'));
    }

    /**
     *
     */
    public function test_invoke_create()
    {
        /** @var Service|Mock $mock */

        $mock = $this->getCleanMock(Service::class, ['__invoke'], [['foo' => 'bar']]);

        $mock->expects($this->once())
             ->method('create')
             ->willReturn('baz');

        $this->assertEquals('baz', $mock->__invoke('foo'));
    }
}
