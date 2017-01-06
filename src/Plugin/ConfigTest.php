<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\App;
use Mvc5\Plugin\Config;
use Mvc5\Test\Test\TestCase;

class ConfigTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $app = new App;
        $app->config(['foo' => 'bar']);

        $this->assertEquals(['foo' => 'bar'], $app->plugin(new Config));
    }
}
