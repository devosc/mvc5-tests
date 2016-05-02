<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\Arg;
use Mvc5\App;
use Mvc5\Plugin\Args;
use Mvc5\Plugin\Plugins;
use Mvc5\Plugin\Link;
use Mvc5\Test\Test\TestCase;

class PluginsTest
    extends TestCase
{
    /**
     *
     */
    function test_construct()
    {
        $plugin = new Plugins(['foo']);

        $this->assertEquals(App::class, $plugin->name());
        $this->assertEquals([new Args([Arg::SERVICES => ['foo']]), new Link, true], $plugin->args());
        $this->assertEquals([], $plugin->calls());
    }

    /**
     *
     */
    function test_construct_no_provider_and_not_scoped_with_calls()
    {
        $plugin = new Plugins(['foo'], null, false, ['bar']);

        $this->assertEquals(App::class, $plugin->name());
        $this->assertEquals([new Args([Arg::SERVICES => new Args(['foo'])]), null, false], $plugin->args());
        $this->assertEquals(['bar'], $plugin->calls());
    }
}
