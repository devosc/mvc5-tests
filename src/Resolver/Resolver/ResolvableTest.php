<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Plugin\Args;
use Mvc5\Plugin\Call;
use Mvc5\Plugin\Calls;
use Mvc5\Plugin\Child;
use Mvc5\Plugin\Config;
use Mvc5\Plugin\Dependency;
use Mvc5\Plugin\Factory;
use Mvc5\Plugin\Filter;
use Mvc5\Plugin\Invoke;
use Mvc5\Plugin\Invokable;
use Mvc5\Plugin\Link;
use Mvc5\Plugin\Plug;
use Mvc5\Plugin\Plugin;
use Mvc5\Plugin\Param;
use Mvc5\Resolvable;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class ResolvableTest
    extends TestCase
{
    /**
     *
     */
    public function test_resolvable()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolvable', 'resolvableTest']);

        $this->assertEquals(false, $mock->resolvableTest(false));
    }

    /**
     *
     */
    public function test_resolvable_service_factory()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolvable', 'resolvableTest']);

        $mock->expects($this->once())
            ->method('child');

        $mock->expects($this->once())
            ->method('invoke')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->resolvableTest(new Factory('foo')));
    }

    /**
     *
     */
    public function test_resolvable_service_calls()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolvable', 'resolvableTest']);

        $mock->expects($this->once())
            ->method('hydrate')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->resolvableTest(new Calls('foo', [])));
    }

    /**
     *
     */
    public function test_resolvable_child_service()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolvable', 'resolvableTest']);

        $mock->expects($this->once())
            ->method('child')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->resolvableTest(new Child('foo', 'bar')));
    }

    /**
     *
     */
    public function test_resolvable_config()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolvable', 'resolvableTest']);

        $mock->expects($this->once())
            ->method('provide')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->resolvableTest(new Plugin(null)));
    }

    /**
     *
     */
    public function test_resolvable_dependency_shared()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolvable', 'resolvableTest']);

        $mock->expects($this->once())
            ->method('shared')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->resolvableTest(new Dependency('foo')));
    }

    /**
     *
     */
    public function test_resolvable_dependency_create()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolvable', 'resolvableTest']);

        $mock->expects($this->once())
            ->method('shared')
            ->willReturn(null);

        $mock->expects($this->once())
            ->method('initialize')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->resolvableTest(new Dependency('foo')));
    }

    /**
     *
     */
    public function test_resolvable_service_param()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolvable', 'resolvableTest']);

        $mock->expects($this->once())
            ->method('param');

        $mock->expects($this->once())
             ->method('resolve')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->resolvableTest(new Param('foo')));
    }

    /**
     *
     */
    public function test_resolvable_service_call()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolvable', 'resolvableTest']);

        $mock->expects($this->once())
            ->method('call')
            ->willReturn('foo');

        $mock->expects($this->once())
            ->method('args')
            ->willReturn([]);

        $this->assertEquals('foo', $mock->resolvableTest(new Call('foo')));
    }

    /**
     *
     */
    public function test_resolvable_args()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolvable', 'resolvableTest']);

        $mock->expects($this->once())
            ->method('args')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->resolvableTest(new Args('foo')));
    }

    /**
     *
     */
    public function test_resolvable_config_link()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolvable', 'resolvableTest']);

        $mock->expects($this->once())
            ->method('config')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->resolvableTest(new Config()));
    }

    /**
     *
     */
    public function test_resolvable_service_manager()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolvable', 'resolvableTest']);

        $this->assertEquals($mock, $mock->resolvableTest(new Link()));
    }

    /**
     *
     */
    public function test_resolvable_filter()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolvable', 'resolvableTest']);

        $mock->expects($this->once())
            ->method('filter')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->resolvableTest(new Filter('foo')));
    }

    /**
     *
     */
    public function test_resolvable_service_config()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolvable', 'resolvableTest']);

        $mock->expects($this->once())
            ->method('configured')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->resolvableTest(new Plug('foo')));
    }

    /**
     *
     */
    public function test_resolvable_service_invoke()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolvable', 'resolvableTest']);

        $mock->expects($this->once())
            ->method('call')
            ->willReturn('foo');

        $mock->expects($this->once())
            ->method('args')
            ->willReturn([]);

        $callable = $mock->resolvableTest(new Invoke('foo'));

        $this->assertEquals('foo', $callable());
    }

    /**
     *
     */
    public function test_resolvable_service_invokable()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolvable', 'resolvableTest']);

        $mock->expects($this->once())
            ->method('solve')
            ->willReturn('foo');

        $callable = $mock->resolvableTest(new Invokable('foo'));

        $this->assertEquals('foo', $callable());
    }

    /**
     *
     */
    public function test_resolvable_callback()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolvable', 'resolvableTest']);

        $resolvable = $this->getCleanMock(Resolvable::class);

        $this->assertEquals('foo', $mock->resolvableTest($resolvable, [], function() { return 'foo'; }));
    }

    /**
     *
     */
    public function test_resolvable_resolver()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolvable', 'resolvableTest']);

        $resolvable = $this->getCleanMock(Resolvable::class);

        $mock->expects($this->once())
             ->method('resolver')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->resolvableTest($resolvable));
    }
}
