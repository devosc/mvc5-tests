<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\App;
use Mvc5\Config;
use Mvc5\Plugin\Register;
use Mvc5\Test\Test\TestCase;

class RegisterTest
    extends TestCase
{
    /**
     *
     */
    function test_not_registered()
    {
        $name    = 'foo';
        $service = new Config;

        $register = new Register($name, $service);

        $result = $register->register(new App, ['name' => $name, 'service' => $service, 'plugin' => null]);

        $this->assertNull($result);
    }

    /**
     *
     */
    function test_register()
    {
        $name    = 'foo';
        $plugin  = new \stdClass;
        $service = new Config;

        $register = new Register($name, $service, $plugin);

        $result = $register->register(new App, ['name' => $name, 'service' => $service, 'plugin' => $plugin]);

        $this->assertTrue($plugin === $result);
        $this->assertTrue($plugin === $service[$name]);
    }

    /**
     *
     */
    function test_registered()
    {
        $name    = 'foo';
        $plugin  = new \stdClass;
        $service = new Config(['foo' => $plugin]);

        $register = new Register($name, $service);

        $result = $register->register(new App, ['name' => $name, 'service' => $service, 'plugin' => null]);

        $this->assertTrue($plugin === $result);
        $this->assertTrue($plugin === $service[$name]);
    }
}
