<?php
/**
 *
 */

namespace Mvc5\Test\Plugins;

use Mvc5\App;
use Mvc5\Log\Error;
use Mvc5\Test\Test\TestCase;

class LogTest
    extends TestCase
{
    /**
     *
     */
    function test_log()
    {
        $config = ['services' => ['log' => Error::class]];

        $plugin = new LogPlugin;
        $plugin->service(new App($config));

        $this->assertTrue($plugin());
    }
}
