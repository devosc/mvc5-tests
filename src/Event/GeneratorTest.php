<?php
/**
 *
 */

namespace Mvc5\Test\Event;

use Mvc5\Config;
use Mvc5\Test\Test\TestCase;
use Traversable;

class GeneratorTest
    extends TestCase
{
    /**
     *
     */
    function test_emit_callable_event()
    {
        $event     = function() { return 'foo'; };
        $generator = new Generator;
        $listener  = function() {};

        $this->assertEquals('foo', $generator->emit($event, $listener));
    }

    /**
     *
     */
    function test_emit_listener()
    {
        $generator = new Generator;

        $this->assertEquals('foo', $generator->emit(null, function() { return 'foo'; }));
    }

    /**
     * @return mixed
     */
    function test_generate()
    {
        $generator = new Generator;

        $this->assertEquals('foo', $generator->generate(new Event));
    }

    /**
     *
     */
    function test_queue_array()
    {
        $generator = new Generator;

        $this->assertEquals(['foo'], $generator->queue(['foo']));
    }

    /**
     *
     */
    function test_queue_traversable()
    {
        $generator = new Generator;

        $this->assertInstanceOf(Traversable::class, $generator->queue(new Config));
    }

    /**
     *
     */
    function test_queue_not_array_or_traversable()
    {
        $generator = new Generator;

        $this->assertEquals(['bar'], $generator->queue('foo'));
    }
}
