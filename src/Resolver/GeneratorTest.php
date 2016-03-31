<?php
/**
 *
 */

namespace Mvc5\Test\Resolver;

use Mvc5\Event;
use Mvc5\Test\Test\TestCase;

class GeneratorTest
    extends TestCase
{

    /**
     *
     */
    public function test_event_name_string()
    {
        $generator = new Generator;

        $this->assertEquals('foo', $generator->eventName('foo'));
    }

    /**
     *
     */
    public function test_event_name_event()
    {
        $generator = new Generator;

        $this->assertEquals('foo', $generator->eventName(new Event('foo')));
    }

    /**
     *
     */
    public function test_event_name_object()
    {
        $generator = new Generator;

        $this->assertEquals('stdClass', $generator->eventName(new \stdClass));
    }

    /**
     * @return mixed
     */
    public function test_events()
    {
        $generator = new Generator;

        $this->assertEquals([], $generator->events());
    }

    /**
     * @return mixed
     */
    public function test_events_return_config()
    {
        $generator = new Generator;

        $this->assertEquals(['foo'], $generator->events(['foo']));
    }

    /**
     * @return mixed
     */
    public function test_listeners_with_config()
    {
        $generator = new Generator;

        $generator->events(['foo' => 'bar']);

        $this->assertEquals('bar', $generator->listeners('foo'));
    }

    /**
     *
     */
    public function test_listeners_without_config()
    {
        $generator = new Generator;

        $this->setExpectedException('RuntimeException');

        $generator->listeners('foo');
    }

    /**
     *
     */
    public function test_traversable()
    {
        $generator = new Generator;

        $generator->events(['foo' => ['bar']]);

        $this->assertEquals(['bar'], $generator->traversable('foo'));
    }
}
