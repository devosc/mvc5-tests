<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Test\Resolver\Resolver\Model\CallableObject;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class InvokableTest
    extends TestCase
{
    /**
     *
     */
    public function test_invokable_call_string()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['invokable', 'invokableTest']);

        $this->assertInstanceOf(\Closure::class, $mock->invokableTest('@foo'));
    }

    /**
     *
     */
    public function test_invokable_call_string_test()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['invokable', 'invokableTest']);

        $mock->expects($this->once())
            ->method('call')
            ->willReturn('foo');

        $this->assertEquals('foo', call_user_func($mock->invokableTest('@foo')));
    }

    /**
     *
     */
    public function test_invokable_string_plugin()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['invokable', 'invokableTest']);

        $mock->expects($this->once())
             ->method('plugin')
             ->willReturn('time');

        $this->assertEquals('time', $mock->invokableTest('foo'));
    }

    /**
     *
     */
    public function test_invokable_call_array()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['invokable', 'invokableTest']);

        $this->assertEquals([CallableObject::class, '__callStatic'], $mock->invokableTest([CallableObject::class, '__callStatic']));
    }

    /**
     *
     */
    public function test_invokable_call_array_service()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['invokable', 'invokableTest']);

        $config = [new CallableObject, 'bar'];

        $mock->expects($this->once())
            ->method('create')
            ->willReturn(new CallableObject);

        $this->assertEquals($config, $mock->invokableTest($config));
    }

    /**
     *
     */
    public function test_invokable_closure()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['invokable', 'invokableTest']);

        $this->assertEquals(function(){}, $mock->invokableTest(function(){}));
    }

    /**
     *
     */
    public function test_invokable_object()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['invokable', 'invokableTest']);

        $object = new CallableObject;

        $mock->expects($this->once())
            ->method('create')
            ->willReturn($object);

        $this->assertEquals($object, $mock->invokableTest($object));
    }
}
