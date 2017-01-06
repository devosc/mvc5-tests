<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\App;
use Mvc5\Config;
use Mvc5\Plugin\Calls;
use Mvc5\Plugin\Plugin;
use Mvc5\Test\Test\TestCase;

class CallsTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $calls = new Calls('session', ['#foo' => 'bar']);

        $this->assertEquals('session', $calls->name());
        $this->assertEquals(['#foo' => 'bar'], $calls->calls());
    }

    /**
     *
     */
    function test_plugin()
    {
        $calls = new Calls(new Plugin(Config::class), ['#foo' => 'bar']);

        $this->assertEquals(new Config(['foo' => 'bar']), (new App)->plugin($calls));
    }
}
