<?php
/**
 *
 */

namespace Mvc5\Test\Plugins;

use Mvc5\App;
use Mvc5\ArrayModel;
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
        $config = ['services' => ['config' => new Config]];

        $plugin = new ConfigPlugin(new App($config));

        $this->assertEquals(new ArrayModel($config), $plugin->config());
    }
}
