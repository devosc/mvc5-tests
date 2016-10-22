<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\App;
use Mvc5\Config;
use Mvc5\Plugin\Session;
use Mvc5\Test\Test\TestCase;

class SessionTest
    extends TestCase
{
    /**
     *
     */
    function test_session_variable_not_exists()
    {
        $name    = 'foo';
        $service = 'session';

        $app = new App(['services' => ['session' => new Config]]);

        $register = new Session($name);

        $result = $register->register($app, ['name' => $name, 'service' => $service, 'plugin' => null]);

        $this->assertNull($result);
    }

    /**
     *
     */
    function test_existing_session_variable()
    {
        $name    = 'foo';
        $service = 'session';
        $plugin  = new \stdClass;

        $app = new App(['services' => ['session' => new Config(['foo' => $plugin])]]);

        $register = new Session($name);

        $result = $register->register($app, ['name' => $name, 'service' => $service, 'plugin' => null]);

        $this->assertTrue($plugin === $result);
        $this->assertTrue($plugin === $app['session'][$name]);
    }

    /**
     *
     */
    function test_register_session_variable()
    {
        $name    = 'foo';
        $plugin  = new \stdClass;
        $service = 'session';

        $app = new App(['services' => ['session' => new Config]]);

        $register = new Session($name, $plugin);

        $result = $register->register($app, ['name' => $name, 'service' => $service, 'plugin' => $plugin]);

        $this->assertTrue($plugin === $result);
        $this->assertTrue($plugin === $app['session'][$name]);
    }
}
