<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Build;

use Mvc5\App;
use Mvc5\Config;
use Mvc5\Test\Test\TestCase;

class BuildTest
    extends TestCase
{
    /**
     *
     */
    function test_build()
    {
        $app = new App;

        $app->configure('foo', Config::class);

        $this->assertInstanceOf(Config::class, $app->plugin('foo'));
    }
}
