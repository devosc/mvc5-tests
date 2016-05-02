<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Build;

use Mvc5\Config;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class CallbackTest
    extends TestCase
{
    /**
     *
     */
    function test_callback_no_class_exists()
    {
        $resolver = new Resolver;

        $this->assertEquals('bar', $resolver->callback('foo', [], function() { return 'bar'; }));
    }

    /**
     *
     */
    function test_callback_no_callback_and_class_exists()
    {
        $resolver = new Resolver;

        $this->assertInstanceOf(Config::class, $resolver->callback(Config::class));
    }

    /**
     *
     */
    function test_callback_and_class_exists()
    {
        $resolver = new Resolver;

        $this->assertInstanceOf(Config::class, $resolver->callback(Config::class, [], function() { }));
    }
}
