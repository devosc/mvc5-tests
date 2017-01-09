<?php
/**
 *
 */

namespace Mvc5\Test\Resolver;

use Mvc5\App;
use Mvc5\Config;
use Mvc5\Test\Test\TestCase;

class ScopeTest
    extends TestCase
{
    /**
     *
     */
    function test_exists()
    {
        $config = new Config;

        $app = new App(null, null, $config);

        $this->assertTrue($config === $app->scope());
    }

    /**
     *
     */
    function test_null()
    {
        $this->assertNull((new App)->scope());
    }

    /**
     *
     */
    function test_set()
    {
        $config = new Config;

        $this->assertTrue($config === (new App)->scope($config));
    }
}
