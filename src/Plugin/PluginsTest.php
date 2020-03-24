<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\App;
use Mvc5\Plugin\Args;
use Mvc5\Plugin\Plugins;
use Mvc5\Plugin\Link;
use Mvc5\Test\Test\TestCase;

use const Mvc5\SERVICES;

class PluginsTest
    extends TestCase
{
    /**
     *
     */
    function test_array_services()
    {
        $plugin = new Plugins(['foo'], true, true, ['bar']);

        $this->assertEquals(App::class, $plugin->name());
        $this->assertEquals([new Args([SERVICES => ['foo']]), new Link, true], $plugin->args());
        $this->assertEquals(['bar'], $plugin->calls());
        $this->assertEquals('item', $plugin->param());
        $this->assertFalse($plugin->merge());
    }

    /**
     *
     */
    function test_no_provider_and_no_scope()
    {
        $plugin = new Plugins(['foo'], null, false, ['bar']);

        $this->assertEquals(App::class, $plugin->name());
        $this->assertEquals([new Args([SERVICES => new Args(['foo'])]), null, false], $plugin->args());
        $this->assertEquals(['bar'], $plugin->calls());
        $this->assertEquals('item', $plugin->param());
        $this->assertFalse($plugin->merge());
    }
}
