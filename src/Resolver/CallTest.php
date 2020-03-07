<?php
/**
 *
 */

namespace Mvc5\Test\Resolver;

use Mvc5\App;
use Mvc5\Event;
use Mvc5\ViewModel;
use Mvc5\Plugin\Callback;
use Mvc5\Plugin\Invoke;
use Mvc5\Plugin\Link;
use Mvc5\Plugin\Value;
use Mvc5\Test\Test\TestCase;

class CallTest
    extends TestCase
{
    /**
     *
     */
    function test_callable()
    {
        $this->assertEquals('foo', (new App)->call(fn() => 'foo'));
    }

    /**
     *
     */
    function test_event()
    {
        $app = new App([
            'events' => [
                'foo' => [fn() => 'foobar']
            ]
        ]);

        $this->assertEquals('foobar', $app->call(new Event('foo')));
    }

    /**
     *
     */
    function test_param_callback()
    {
        $model = new ViewModel(['foo' => 'foobar']);

        $this->assertEquals('foobar', (new App)->call([$model, 'get'], [], fn() => 'foo'));
    }

    /**
     *
     */
    function test_plugin()
    {
        $this->assertEquals('foo', (new App)->call(new Invoke(fn() => 'foo')));
    }

    /**
     *
     */
    function test_relay()
    {
        $app = new App([
            'services' => [
                'model' => new class() {
                    function service($service) {
                        return $service;
                    }
                },
                'service' => new Link,
                'test' => new Value('foobar')
            ]
        ]);

        $this->assertEquals('foobar', $app->call('model.service.plugin', ['test']));
        $this->assertEquals('foobar', $app->call('model.service.plugin', ['plugin' => 'test']));
    }

    /**
     *
     */
    function test_string_event()
    {
        $app = new App([
            'events' => [
                'test_event' => [
                    fn() => 'foo'
                ]
            ],
            'services' => [
                'test\event' => [Event::class, 'test_event']
            ]
        ]);

        $this->assertEquals('foo', $app->call('test\event'));
    }

    /**
     *
     */
    function test_string_fallback()
    {
        $app = new App([
            'events' => [
                'test_event' => [fn() => 'foo']
            ],
            'services' => [
                'event\model' => Event::class
            ]
        ]);

        $this->assertEquals('foo', $app->call('test_event'));
    }

    /**
     *
     */
    function test_string_fallback_exception()
    {
        $this->expectExceptionMessage('Unresolvable plugin: test_event');

        (new App)->call('test_event');
    }

    /**
     *
     */
    function test_string_prefix()
    {
        $this->assertEquals(phpversion(), (new App)->call('@phpversion'));
    }

    /**
     *
     */
    function test_string_service()
    {
        $app = new App([
            'services' => [
                'foo' => fn() => fn() => 'foobar'
            ]
        ]);

        $this->assertEquals('foobar', $app->call('foo'));
    }

    /**
     *
     */
    function test_call_overload()
    {
        $config = [
            'services' => [
                'foo' => new Callback(fn($bar) => $this->foobar('foo' . $bar)),
                'foobar' => new Invoke(fn($foobar) => $foobar),
            ]
        ];

        $app = new App($config, null, true);

        $this->assertEquals('foobar', $app->foo('bar'));
    }
}
