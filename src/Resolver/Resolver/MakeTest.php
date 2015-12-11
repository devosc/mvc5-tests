<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Test\Resolver\Resolver\Model\Autowire;
use Mvc5\Test\Resolver\Resolver\Model\AutowireMissingParam;
use Mvc5\Test\Resolver\Resolver\Model\AutowireNoConstructor;
use Mvc5\Test\Resolver\Resolver\Model\AutowireNoConstructorArgs;
use Mvc5\Test\Resolver\Resolver\Model\CallEvent;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class MakeTest
    extends TestCase
{
    /**
     *
     */
    public function test_make()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['make', 'makeTest']);

        $mock->expects($this->once())
            ->method('create')
            ->willReturn(new CallEvent);

        $this->assertInstanceOf(Autowire::class, $mock->makeTest(Autowire::class, ['foo' => 'bar']));
    }

    /**
     *
     */
    public function test_make_without_constructor()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['make', 'makeTest']);

        $this->assertInstanceOf(AutowireNoConstructor::class, $mock->makeTest(AutowireNoConstructor::class));
    }

    /**
     *
     */
    public function test_make_no_named_args()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['make', 'makeTest']);

        $args = [new CallEvent, 'foo'];

        $mock->expects($this->once())
            ->method('args')
            ->willReturn($args);

        $this->assertInstanceOf(Autowire::class, $mock->makeTest(Autowire::class, $args));
    }

    /**
     *
     */
    public function test_make_with_named_args()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['make', 'makeTest']);

        $args = ['event' => new CallEvent, 'foo' => 'bar'];

        $mock->expects($this->any())
            ->method('resolve')
            ->will($this->onConsecutiveCalls($args['event'], $args['foo']));

        $this->assertInstanceOf(Autowire::class, $mock->makeTest(Autowire::class, $args));
    }

    /**
     *
     */
    public function test_make_with_named_args_but_no_constructor_args()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['make', 'makeTest']);

        $args = ['event' => new CallEvent, 'foo' => 'bar'];

        $mock->expects($this->once())
            ->method('args')
            ->willReturn($args);

        $class = AutowireNoConstructorArgs::class;

        $this->assertInstanceOf($class, $mock->makeTest($class, $args));
    }

    /**
     *
     */
    public function test_make_with_callback_param()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['make', 'makeTest']);

        $event = new CallEvent;

        $mock->expects($this->once())
            ->method('resolve')
            ->willReturn($event);

        $this->assertInstanceOf(
            Autowire::class,
            $mock->makeTest(Autowire::class, ['event' => $event], function() { return 'bar'; })
        );
    }

    /**
     *
     */
    public function test_make_with_missing_param()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['make', 'makeTest']);

        $this->setExpectedException('RuntimeException');

        $this->assertInstanceOf(AutowireMissingParam::class, $mock->makeTest(AutowireMissingParam::class));
    }
}
