<?php
/**
 *
 */

namespace Mvc5\Test\Plugins;

use Mvc5\App;
use Mvc5\Log\ErrorLog;
use Mvc5\Test\Test\TestCase;

class LogTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $app = new App(['services' => ['log' => ErrorLog::class]]);

        $plugin = new LogPlugin($app);

        $this->assertTrue($plugin->log('Hello!'));
    }
}
