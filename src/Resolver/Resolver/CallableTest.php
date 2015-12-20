<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Test\Resolver\Resolver\Model\CallableObject;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class CallableTest
    extends TestCase
{
    /**
     *
     */
    public function test_callable_string()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['callable', 'callableTest']);

        $this->assertInstanceOf(\Closure::class, $mock->callableTest('foo'));
    }

    /**
     *
     */
    public function test_callable_array_string()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['callable', 'callableTest']);

        $config = [CallableObject::class, 'test'];

        $this->assertEquals($config, $mock->callableTest($config));
    }

    /**
     *
     */
    public function test_callable_array_object()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['callable', 'callableTest']);

        $config = [new CallableObject, 'test'];

        $mock->expects($this->once())
             ->method('resolve')
             ->willReturn($config[0]);

        $this->assertEquals($config, $mock->callableTest($config));
    }

    /**
     *
     */
    public function test_callable_closure()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['callable', 'callableTest']);

        $this->assertEquals(function(){}, $mock->callableTest(function(){}));
    }

    /**
     *
     */
    public function test_callable_object()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['callable', 'callableTest']);

        $obj = new CallableObject;

        $mock->expects($this->once())
             ->method('resolve');

        $mock->expects($this->once())
             ->method('listener')
             ->willReturn($obj);

        $this->assertEquals($obj, $mock->callableTest($obj));
    }
}
