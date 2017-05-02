<?php
/**
 *
 */

namespace Mvc5\Test\Plugins;

use Mvc5\App;
use Mvc5\Config;
use Mvc5\Test\Test\TestCase;

class UserTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $config = ['services' => ['user' => Config::class]];

        $plugin = new UserPlugin(new App($config));

        $this->assertInstanceOf(Config::class, $plugin->user());
    }
}
