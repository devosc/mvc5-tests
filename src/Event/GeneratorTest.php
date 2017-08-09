<?php
/**
 *
 */

namespace Mvc5\Test\Event;

use Mvc5\App;
use Mvc5\Config;
use Mvc5\Event as Mvc5Event;
use Mvc5\Event\Event;
use Mvc5\Test\Test\TestCase;

class GeneratorTest
    extends TestCase
{
    /**
     * @param array $config
     * @return App
     */
    protected function app(array $config = [])
    {
        return new App($this->config($config));
    }

    /**
     * @param Event $event
     * @param bool $stop
     * @return string
     */
    static function bar(Event $event = null, $stop = false)
    {
        $event && $stop && $event->stop();
        return 'bar';
    }

    /**
     * @return string
     */
    static function baz()
    {
        return 'baz';
    }

    /**
     * @param array $config
     * @return array
     */
    protected function config(array $config = [])
    {
        return $config + [
            'events' => [
                'test_event' => [
                    '@Mvc5\Test\Event\GeneratorTest::foo',
                    '@Mvc5\Test\Event\GeneratorTest::bar',
                    '@Mvc5\Test\Event\GeneratorTest::baz'
                ],
                'test_event_iterator' => new Config([
                    '@Mvc5\Test\Event\GeneratorTest::foo',
                    '@Mvc5\Test\Event\GeneratorTest::bar',
                    '@Mvc5\Test\Event\GeneratorTest::baz'
                ]),
                'stdClass' => [
                    '@Mvc5\Test\Event\GeneratorTest::foo'
                ]
            ]
        ];
    }

    /**
     * @return string
     */
    static function foo()
    {
        return 'foo';
    }

    /**
     *
     */
    function test_call_event()
    {
        $app = $this->app([
            'services' => [
                'event\model' => Mvc5Event::class,
                'test\event'  => [Mvc5Event::class, 'test_event']
            ]
        ]);

        $this->assertEquals('baz', $app->call('test_event'));
        $this->assertEquals('baz', $app->call(new Mvc5Event('test_event')));
        $this->assertEquals('baz', $app->call('test\event'));
    }

    /**
     *
     */
    function test_event()
    {
        $this->assertEquals('baz', $this->app()->trigger('test_event'));
    }

    /**
     *
     */
    function test_event_array()
    {
        $app = new App([
            'services' => [
                'test_event' => function() {
                    return [
                        '@Mvc5\Test\Event\GeneratorTest::foo',
                        '@Mvc5\Test\Event\GeneratorTest::bar',
                        '@Mvc5\Test\Event\GeneratorTest::baz',
                    ];
                }
            ]
        ]);

        $this->assertEquals('baz', $app->trigger('test_event'));
    }

    /**
     *
     */
    function test_event_iterator()
    {
        $this->assertEquals('baz', $this->app()->trigger(new Mvc5Event('test_event_iterator')));
    }

    /**
     *
     */
    function test_event_not_found_exception()
    {
        $this->expectExceptionMessage('Unresolvable plugin: foo');

        (new App)->trigger('foo');
    }

    /**
     *
     */
    function test_event_object()
    {
        $this->assertEquals('baz', $this->app()->trigger(new Mvc5Event('test_event')));
    }

    /**
     *
     */
    function test_event_object_stopped()
    {
        $this->assertEquals('bar', $this->app()->trigger(new Mvc5Event('test_event'), ['stop' => true]));
    }

    /**
     *
     */
    function test_events()
    {
        $this->assertEquals([], (new App)->events());
        $this->assertEquals(['foo' => []], (new App(['events' => ['foo' => []]]))->events());
    }

    /**
     *
     */
    function test_object_event()
    {
        $this->assertEquals('foo', $this->app()->trigger(new \stdClass));
    }

    /**
     *
     */
    function test_repeat_event()
    {
        $this->assertEquals('baz', $this->app()->trigger('test_event'));
        $this->assertEquals('baz', $this->app()->trigger('test_event'));
    }

    /**
     *
     */
    function test_repeat_event_iterator()
    {
        $app = $this->app();

        $this->assertEquals('baz', $app->trigger('test_event_iterator'));
        $this->assertEquals('baz', $app->trigger('test_event_iterator'));
    }

    /**
     *
     */
    function test_serialized_repeat_event()
    {
        $app = $this->app();

        $this->assertEquals('baz', $app->trigger('test_event'));
        $this->assertEquals('baz', $app->trigger('test_event'));

        $app = unserialize(serialize($app));

        $this->assertEquals('baz', $app->trigger('test_event'));
        $this->assertEquals('baz', $app->trigger('test_event'));
    }

    /**
     *
     */
    function test_serialized_repeat_event_iterator()
    {
        $app = $this->app();

        $this->assertEquals('baz', $app->trigger('test_event_iterator'));
        $this->assertEquals('baz', $app->trigger('test_event_iterator'));

        $app = unserialize(serialize($app));

        $this->assertEquals('baz', $app->trigger('test_event_iterator'));
        $this->assertEquals('baz', $app->trigger('test_event_iterator'));
    }

    /**
     *
     */
    function test_traversable_event()
    {
        $this->assertEquals('baz', $this->app()->trigger(new EventIterator([
            '@Mvc5\Test\Event\GeneratorTest::foo',
            '@Mvc5\Test\Event\GeneratorTest::bar',
            '@Mvc5\Test\Event\GeneratorTest::baz'
        ])));
    }

    /**
     *
     */
    function test_middleware_event()
    {
        $this->assertEquals('baz', $this->app()->trigger(new MiddlewareEvent($this->app(), [
            function($value, $next) {
                return $next($value . 'a');
            },
            function($value, $next) {
                return $next($value . 'z');
            }
        ]), ['b']));
    }
}
