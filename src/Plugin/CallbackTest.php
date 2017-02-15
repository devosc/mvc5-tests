<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\App;
use Mvc5\Plugin\Callback;
use Mvc5\Test\Test\TestCase;

class CallbackTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $app = new App(null, null, true);

        $result = $app->call(new Callback(function() {
            return $this;
        }));

        $this->assertTrue($result === $app);
    }

    /**
     *
     */
    function test_no_app_scope()
    {
        $app = new App;

        $result = $app->call(new Callback(function() {
            return $this;
        }));

        $this->assertTrue($result === $this);
    }
}
