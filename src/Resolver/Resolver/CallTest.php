<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\App;
use Mvc5\Arg;
use Mvc5\Test\Resolver\Resolver\Model\CallableObject;
use Mvc5\Test\Resolver\Resolver\Model\CallEvent;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class CallTest
    extends TestCase
{
    /**
     *
     */
    public function test_call_not_string_event()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['call']);

        $mock->expects($this->once())
             ->method('generate')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->call(new CallEvent));
    }

    /**
     *
     */
    public function test_call_not_string_invoke()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['call']);

        $mock->expects($this->once())
             ->method('invoke')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->call(new \stdClass));
    }

    /**
     *
     */
    public function test_call_plugin()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['call']);

        $mock->expects($this->once())
             ->method('plugin')
             ->willReturn('foo');

        $mock->expects($this->once())
             ->method('invoke')
             ->willReturn('bar');

        $this->assertEquals('bar', $mock->call('foo'));
    }

    /**
     *
     */
    public function test_call_plugin_with_call_sign()
    {
        /** @var Resolver|Mock $mock */

        $app = new App([
            Arg::ALIAS => [
                Arg::SERVICE_LOCATOR => function() { return null; }
            ]
        ]);

        $this->assertEquals(phpversion(), $app->call('@phpversion'));
    }

    /**
     *
     */
    public function test_call_plugin_event()
    {
        /** @var Resolver|Mock $mock */

        $app = new App([
            Arg::ALIAS => [
                'foo' => function() { return 'bar'; },
                Arg::SERVICE_LOCATOR => function() { return 'foo'; }
            ]
        ]);

        $this->assertEquals('bar', $app->call('foo'));
    }

    /**
     *
     */
    public function test_call_plugin_exception()
    {
        /** @var Resolver|Mock $mock */

        $app = new App([
            Arg::ALIAS => [
                Arg::SERVICE_LOCATOR => function() { return null; }
            ]
        ]);

        $this->setExpectedException('RuntimeException', 'Unresolvable plugin: foo');

        $app->call('foo');
    }

    /**
     *
     */
    public function test_call_event()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['call']);

        $mock->expects($this->once())
             ->method('plugin')
             ->willReturn(new CallEvent);

        $mock->expects($this->once())
             ->method('generate')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->call('bar'));
    }

    /**
     *
     */
    public function test_call_static()
    {
        /** @var Resolver|Mock $mock */

        $this->assertEquals('foo', (new App)->call(CallableObject::class.'::test'));
    }

    /**
     *
     */
    public function test_call_invoke()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['call']);

        $mock->expects($this->once())
             ->method('plugin');

        $mock->expects($this->any())
             ->method('invoke')
             ->will($this->onConsecutiveCalls('bar', 'foo'));

        $this->assertEquals('foo', $mock->call('bar.baz.foobar'));
    }
}
