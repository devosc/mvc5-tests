<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\App;
use Mvc5\Config;
use Mvc5\Plugin\Args;
use Mvc5\Plugin\Plugin;
use Mvc5\Test\Test\TestCase;

class ArgsTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $args = new Args(['foo' => 'bar']);

        $this->assertEquals(['foo' => 'bar'], $args->config());
    }

    /**
     *
     */
    function test_array()
    {
        $args = new Args(['foo' => new Plugin(Config::class)]);

        $this->assertEquals(['foo' => new Config], (new App)->plugin($args));
    }

    /**
     *
     */
    function test_not_array()
    {
        $args = new Args(new Plugin(Config::class));

        $this->assertInstanceOf(Config::class, (new App)->plugin($args));
    }

    /**
     *
     */
    function test_empty()
    {
        $args = new Args(null);

        $this->assertNull((new App)->plugin($args));
    }
}
