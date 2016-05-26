<?php
/**
 *
 */

namespace Mvc5\Test\Event;

use Mvc5\App;
use Mvc5\Config;
use Mvc5\Test\Test\TestCase;
use Traversable;

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
                    function() {
                        return 'foo';
                    }
                ],
                'test_event' => [
                    function() {
                        return 'foo';
                    }
                ],
                'test_event_stopped' => [
                    function() {
                        return 'foo';
                    },
                    function(TestEvent $event) {
                        $event->stop();
                        return 'bar';
                    },
                    function() {
                        return 'baz';
                    },
                ],
                'test_event_iterator' => new Config([
                    function() {
                        return 'foo';
                    },
                    function() {
                        return 'bar';
                    },
                    function() {
                        return 'baz';
                    },
                ])
            ],
            'services' => [
                'test_event' => TestEvent::class,
                'test_event_array' => function() {
                    return [
                        function() {
                            return 'a';
                        },
                        function() {
                            return 'b';
                        },
                        function() {
                            return 'c';
                        },
                    ];
                }
            ]
        ];

        return new App($config);
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
     * @return mixed
     */
    function test_generate()
    {
        $this->assertEquals('foo', $this->app()->trigger(new TestEvent));
    }

    /**
     * @return mixed
     */
    function test_iterate_event_stopped()
    {
        $this->assertEquals('bar', $this->app()->trigger(new TestEvent('test_event_stopped')));
    }

    /**
     * @return mixed
     */
    function test_iterate_event_array()
    {
        $this->assertEquals('c', $this->app()->trigger('test_event_array'));
    }

    /**
     * @return mixed
     */
    function test_iterate_event_iterator()
    {
        $this->assertEquals('baz', $this->app()->trigger(new TestEvent('test_event_iterator')));
    }
}
