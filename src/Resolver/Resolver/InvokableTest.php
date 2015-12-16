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
    public function test_invokable_string_call_prefix()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['invokable', 'invokableTest']);

        $this->assertEquals('time', $mock->invokableTest('@time'));
    }

    /**
     *
     */
    public function test_invokable_string_plugin()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['invokable', 'invokableTest']);

        $mock->expects($this->once())
             ->method('listener')
             ->willReturn('time');

        $mock->expects($this->once())
             ->method('plugin');

        $this->assertEquals('time', $mock->invokableTest('foo'));
    }

    /**
     *
     */
    public function test_invokable_string_not_plugin()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getMockForAbstractClass(Resolver::class);

        $this->assertEquals('time', $mock->invokableTest('time'));
    }

    /**
     *
     */
    public function test_invokable_array_string()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['invokable', 'invokableTest']);

        $config = [CallableObject::class, 'test'];

        $this->assertEquals($config, $mock->invokableTest($config));
    }

    /**
     *
     */
    public function test_invokable_array_object()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['invokable', 'invokableTest']);

        $config = [new CallableObject, 'test'];

        $mock->expects($this->once())
             ->method('plugin')
             ->willReturn($config[0]);

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

        $obj = new CallableObject;

        $mock->expects($this->once())
            ->method('plugin');

        $mock->expects($this->once())
            ->method('listener')
            ->willReturn($obj);

        $this->assertEquals($obj, $mock->invokableTest($obj));
    }
}
