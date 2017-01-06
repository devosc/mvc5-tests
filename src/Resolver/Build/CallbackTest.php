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

        $this->assertEquals('bar', $resolver->callback('foo', null, [], function() { return 'bar'; }));
    }

    /**
     *
     */
    function test_callback_and_class_exists()
    {
        $resolver = new Resolver;

        $this->assertFalse($resolver->strict());

        $this->assertInstanceOf(Config::class, $resolver->callback(Config::class, null, [], function() { }));
    }

    /**
     *
     */
    function test_callback_no_callback_not_strict()
    {
        $resolver = new Resolver;

        $this->assertFalse($resolver->strict());

        $this->assertInstanceOf(Config::class, $resolver->callback(Config::class));
    }

    /**
     *
     */
    function test_callback_no_callback_strict_with_config()
    {
        $resolver = new Resolver;

        $resolver->setStrict(true);

        $this->assertTrue($resolver->strict());

        $this->assertInstanceOf(Config::class, $resolver->callback(Config::class, Config::class));
    }

    /**
     *
     */
    function test_callback_no_callback_strict_config_not_exists()
    {
        $resolver = new Resolver;

        $resolver->setStrict(true);

        $this->assertTrue($resolver->strict());

        $this->assertNull($resolver->callback(Config::class));
    }

    /**
     *
     */
    function test_callback_no_callback_strict_config_exists()
    {
        $resolver = new Resolver;

        $resolver->setStrict(true);

        $resolver->configure(Config::class, Config::class);

        $this->assertTrue($resolver->strict());

        $this->assertInstanceOf(Config::class, $resolver->callback(Config::class));
    }
}
