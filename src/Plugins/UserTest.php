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
    function test_user()
    {
        $config = ['services' => ['user' => Config::class]];

        $plugin = new UserPlugin;
        $plugin->service(new App($config));

        $this->assertInstanceOf(Config::class, $plugin());
    }
}
