<?php
/**
 *
 */

namespace Mvc5\Test\Service;

use Mvc5\Test\Test\TestCase;

class PluginTest
    extends TestCase
{
    /**
     *
     */
    function test_call()
    {
        $plugin = new Plugin(new Service);

        $this->assertEquals('foo', $plugin->call(null));
    }

    /**
     *
     */
    function test_param()
    {
        $plugin = new Plugin(new Service);

        $this->assertEquals('foo', $plugin->param(null));
    }

    /**
     *
     */
    function test_plugin()
    {
        $plugin = new Plugin(new Service);

        $this->assertEquals('foo', $plugin->plugin(null));
    }

    /**
     *
     */
    function test_shared()
    {
        $plugin = new Plugin(new Service);

        $this->assertEquals('foo', $plugin->shared(null));
    }

    /**
     *
     */
    function test_trigger()
    {
        $plugin = new Plugin(new Service);

        $this->assertEquals('foo', $plugin->trigger(null));
    }
}
