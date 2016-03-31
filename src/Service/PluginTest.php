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
    public function test_call()
    {
        $plugin = new Plugin(new Service);

        $this->assertEquals('foo', $plugin->call(null));
    }

    /**
     *
     */
    public function test_param()
    {
        $plugin = new Plugin(new Service);

        $this->assertEquals('foo', $plugin->param(null));
    }

    /**
     *
     */
    public function test_plugin()
    {
        $plugin = new Plugin(new Service);

        $this->assertEquals('foo', $plugin->plugin(null));
    }

    /**
     *
     */
    public function test_trigger()
    {
        $plugin = new Plugin(new Service);

        $this->assertEquals('foo', $plugin->trigger(null));
    }
}
