<?php
/**
 *
 */

namespace Mvc5\Test\Event;

use Mvc5\App;
use Mvc5\Config;
use Mvc5\Event;
use Mvc5\Test\Test\TestCase;

class GeneratorTest
    extends TestCase
{
    /**
     * @return App
     */
    protected function app()
    {
        $config = [
            'events' => [
                'string_event' => [
                    '@Mvc5\Test\Event\GeneratorTest::foo'
                ],
                'test_event' => [
                    '@Mvc5\Test\Event\GeneratorTest::foo'
                ],
                'test_event_stopped' => [
                    '@Mvc5\Test\Event\GeneratorTest::foo',
                    function(Event $event) {
                        $event->stop();
                        return 'bar';
                    },
                    '@Mvc5\Test\Event\GeneratorTest::baz',
                ],
                'test_event_iterator' => new Config([
                    '@Mvc5\Test\Event\GeneratorTest::foo',
                    '@Mvc5\Test\Event\GeneratorTest::bar',
                    '@Mvc5\Test\Event\GeneratorTest::baz',
                ]),
                'test_event_repeat' => [
                    '@Mvc5\Test\Event\GeneratorTest::foo',
                    '@Mvc5\Test\Event\GeneratorTest::bar',
                    '@Mvc5\Test\Event\GeneratorTest::baz',
                ]
            ],
            'services' => [
                'test_event_array' => function() {
                    return [
                        '@Mvc5\Test\Event\GeneratorTest::foo',
                        '@Mvc5\Test\Event\GeneratorTest::bar',
                        '@Mvc5\Test\Event\GeneratorTest::baz',
                    ];
                }
            ]
        ];

        return new App($config);
    }

    /**
     * @return string
     */
    static function bar()
    {
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
     * @return string
     */
    static function foo()
    {
        return 'foo';
    }

    /**
     *
     */
    function test_emit_event()
    {
        $this->assertEquals('foo', $this->app()->trigger('test_event'));
    }

    /**
     *
     */
    function test_emit_string_event_listener()
    {
        $this->assertEquals('foo', $this->app()->trigger('string_event'));
    }

    /**
     *
     */
    function test_generate()
    {
        $this->assertEquals('foo', $this->app()->trigger(new Event('test_event')));
    }

    /**
     *
     */
    function test_iterate_event_stopped()
    {
        $this->assertEquals('bar', $this->app()->trigger(new Event('test_event_stopped')));
    }

    /**
     *
     */
    function test_iterate_event_array()
    {
        $this->assertEquals('baz', $this->app()->trigger('test_event_array'));
    }

    /**
     *
     */
    function test_iterate_event_iterator()
    {
        $this->assertEquals('baz', $this->app()->trigger(new Event('test_event_iterator')));
    }

    /**
     *
     */
    function test_repeat_event()
    {
        $app = new App([
            'events' => [
                'test_event_repeat' => [
                    '@Mvc5\Test\Event\GeneratorTest::foo',
                    '@Mvc5\Test\Event\GeneratorTest::bar',
                    '@Mvc5\Test\Event\GeneratorTest::baz'
                ]
            ]
        ]);

        $this->assertEquals('baz', $app->trigger('test_event_repeat'));
        $this->assertEquals('baz', $app->trigger('test_event_repeat'));
    }

    /**
     *
     */
    function test_repeat_event_iterator()
    {
        $app = new App([
            'events' => [
                'test_event_repeat' => new Config([
                    '@Mvc5\Test\Event\GeneratorTest::foo',
                    '@Mvc5\Test\Event\GeneratorTest::bar',
                    '@Mvc5\Test\Event\GeneratorTest::baz'
                ])
            ]
        ]);

        $this->assertEquals('baz', $app->trigger('test_event_repeat'));
        $this->assertEquals('baz', $app->trigger('test_event_repeat'));
    }

    /**
     *
     */
    function test_serialized_repeat_event()
    {
        $app = new App([
            'events' => [
                'test_event_repeat' => [
                    '@Mvc5\Test\Event\GeneratorTest::foo',
                    '@Mvc5\Test\Event\GeneratorTest::bar',
                    '@Mvc5\Test\Event\GeneratorTest::baz',
                ]
            ]
        ]);

        $this->assertEquals('baz', $app->trigger('test_event_repeat'));
        $this->assertEquals('baz', $app->trigger('test_event_repeat'));

        $app = unserialize(serialize($app));

        $this->assertEquals('baz', $app->trigger('test_event_repeat'));
        $this->assertEquals('baz', $app->trigger('test_event_repeat'));
    }

    /**
     *
     */
    function test_serialized_repeat_event_iterator()
    {
        $app = new App([
            'events' => [
                'test_event_repeat' => new Config([
                    '@Mvc5\Test\Event\GeneratorTest::foo',
                    '@Mvc5\Test\Event\GeneratorTest::bar',
                    '@Mvc5\Test\Event\GeneratorTest::baz'
                ])
            ]
        ]);

        $this->assertEquals('baz', $app->trigger('test_event_repeat'));
        $this->assertEquals('baz', $app->trigger('test_event_repeat'));

        $app = unserialize(serialize($app));

        $this->assertEquals('baz', $app->trigger('test_event_repeat'));
        $this->assertEquals('baz', $app->trigger('test_event_repeat'));
    }

    /**
     *
     */
    function test_call_event()
    {
        $app = new App([
            'events' => [
                'test_event' => [
                    '@Mvc5\Test\Event\GeneratorTest::foo'
                ],
            ],
            'services' => [
                'event\model' => Event::class
            ]
        ]);

        $this->assertEquals('foo', $app->call('test_event'));
        $this->assertEquals('foo', $app->call(new Event('test_event')));
    }

    /**
     *
     */
    function test_object_event()
    {
        $app = new App([
            'events' => [
                \stdClass::class => [
                    '@Mvc5\Test\Event\GeneratorTest::foo'
                ]
            ]
        ]);

        $this->assertEquals('foo', $app->trigger(new \stdClass));
    }

    /**
     *
     */
    function test_events()
    {
        $this->assertEquals([], (new App)->events());
        $this->assertEquals(['foo' => []], (new App(['events' => ['foo' => []]]))->events());
        $this->assertEquals(['foo' => []], (new App)->events(['foo' => []]));
    }


    /**
     *
     */
    function test_event_not_found_exception()
    {
        $this->setExpectedException('RuntimeException', 'Unresolvable plugin: foo');

        (new App)->trigger('foo');
    }
}
