<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\App;
use Mvc5\Arg;
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
             ->method('trigger')
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
    public function test_call_plugin_callable()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['call', 'plugin']);

        $mock->expects($this->once())
             ->method('invoke')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->call('time'));
    }

    /**
     *
     */
    public function test_call_plugin_not_callable()
    {
        /** @var Resolver|Mock $mock */

        $app = new App([Arg::ALIAS => [Arg::SERVICE_LOCATOR => function() { return null; }]]);

        $this->setExpectedException('RuntimeException');

        $app->call('foo');
    }

    /**
     *
     */
    public function test_call_plugin_callable_event()
    {
        /** @var Resolver|Mock $mock */

        $app = new App([
            'alias'  => [Arg::SERVICE_LOCATOR  => function() { return new CallEvent; } ],
            'events' => ['callable:event' => [function() { return 'bar'; } ]]
        ]);

        $this->assertEquals('bar', $app->call('foo'));
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
             ->method('trigger')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->call('bar'));
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
