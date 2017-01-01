<?php
/**
 *
 */

namespace Mvc5\Test;

use Mvc5\App;
use Mvc5\Test\Test\TestCase;

class PluginTest
    extends TestCase
{
    /**
     *
     */
    function test_service_empty()
    {
        $plugin = new Plugin;

        $this->assertNull($plugin->service());
    }

    /**
     *
     */
    function test_service_not_empty()
    {
        $app = new App;
        $plugin = new Plugin;

        $this->assertEquals($app, $plugin->service($app));
    }
}
