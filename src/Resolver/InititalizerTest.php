<?php
/**
 *
 */

namespace Mvc5\Test\Resolver;

use Mvc5\Config;
use Mvc5\Test\Test\TestCase;

class InitializerTest
    extends TestCase
{
    /**
     *
     */
    public function test_initialize()
    {
        $initializer = new Initializer;

        $this->assertInstanceOf(Config::class, $initializer->initialize(Config::class));
    }

    /**
     *
     */
    public function test_initialize_not_initializing()
    {
        $initializer = new Initializer;

        $initializer->setPending(['foo' => true]);

        $this->setExpectedException('RuntimeException');

        $initializer->initialize('foo');
    }

    /**
     *
     */
    public function test_initialized()
    {
        $initializer = new Initializer;

        $this->assertEquals(null, $initializer->initialized('foo'));
    }

    /**
     *
     */
    public function test_initialized_set()
    {
        $initializer = new Initializer;

        $this->assertEquals('bar', $initializer->initialized('foo', 'bar'));
    }

    /**
     *
     */
    public function test_initializing()
    {
        $initializer = new Initializer;

        $initializer->setPending(['foo' => true]);

        $this->setExpectedException('RuntimeException');

        $initializer->initializing('foo');
    }

    /**
     *
     */
    public function test_initializing_not_pending()
    {
        $initializer = new Initializer;

        $this->assertEquals(null, $initializer->initializing('foo'));
    }
}
