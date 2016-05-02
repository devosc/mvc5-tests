<?php
/**
 *
 */

namespace Mvc5\Test;

use Mvc5\App;
use Mvc5\Service\Service;
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

        $this->assertEquals(null, $plugin->service());
    }

    /**
     *
     */
    function test_service_not_empty()
    {
        $plugin = new Plugin;

        $this->assertInstanceOf(Service::class, $plugin->service(new App));
    }
}
