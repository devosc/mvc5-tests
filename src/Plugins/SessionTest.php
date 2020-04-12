<?php
/**
 *
 */

namespace Mvc5\Test\Plugins;

use Mvc5\App;
use Mvc5\Session\PHPSession;
use Mvc5\Plugin\Hydrator;
use Mvc5\Test\Test\TestCase;

final class SessionTest
    extends TestCase
{
    /**
     *
     */
    function test_session()
    {
        $config = ['services' => ['session' => PHPSession::class]];

        $plugin = new SessionPlugin(new App($config));

        $this->assertInstanceOf(PHPSession::class, $plugin->session());
    }

    /**
     *
     */
    function test_session_param()
    {
        $config = ['services' => ['session' => new Hydrator(PHPSession::class, ['$foo' => 'bar'])]];

        $plugin = new SessionPlugin(new App($config));

        $this->assertEquals('bar', $plugin->session('foo'));
    }
}
