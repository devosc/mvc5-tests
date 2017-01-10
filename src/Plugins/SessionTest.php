<?php
/**
 *
 */

namespace Mvc5\Test\Plugins;

use Mvc5\App;
use Mvc5\Session\Config as Session;
use Mvc5\Plugin\Hydrator;
use Mvc5\Test\Test\TestCase;

class SessionTest
    extends TestCase
{
    /**
     *
     */
    function test_session()
    {
        $config = ['services' => ['session' => Session::class]];

        $plugin = new SessionPlugin;
        $plugin->service(new App($config));

        $this->assertInstanceOf(Session::class, $plugin->session());
    }
    /**
     *
     */
    function test_session_param()
    {
        $config = ['services' => ['session' => new Hydrator(Session::class, ['$foo' => 'bar'])]];

        $plugin = new SessionPlugin;
        $plugin->service(new App($config));

        $this->assertEquals('bar', $plugin->session('foo'));
    }
}
