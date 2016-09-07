<?php
/**
 *
 */

namespace Mvc5\Test\Session;


use Mvc5\Cookie\Container as CookieContainer;
use Mvc5\Cookie\Config as Cookies;
use Mvc5\Session\Config;
use Mvc5\Session\Container;
use Mvc5\Test\Test\TestCase;

class StartTest
    extends TestCase
{
    /**
     * @return Container
     */
    protected function container()
    {
        return new Container(new Config(new Cookies(new CookieContainer)));
    }

    /**
     *
     */
    function test_construct()
    {
        $this->assertInstanceOf(Start::class, new Start($this->container()));
    }

    /**
     *
     */
    function test_active()
    {
        @session_start();

        $container = $this->container();

        $start = new Start($container);

        $this->assertTrue($start->active($container));

        session_destroy();
    }

    /**
     *
     */
    function test_register()
    {
        @session_start();

        $container = $this->container();

        $start = new Start($container);

        $this->assertFalse(isset($_SESSION[$container->label()]));

        $start->register($container);

        $this->assertTrue(isset($_SESSION[$container->label()]));

        session_destroy();
    }

    /**
     *
     */
    function test_start()
    {
        $container = $this->container();

        $start = new Start($container);

        $this->assertEquals(PHP_SESSION_NONE, $container->status());

        @$start->start($container);

        $this->assertEquals(PHP_SESSION_ACTIVE, $container->status());

        session_destroy();
    }

    /**
     *
     */
    function test_invoke_register()
    {
        @session_start();

        $container = $this->container();

        $start = new Start($container);

        $this->assertFalse(isset($_SESSION[$container->label()]));

        $start();

        $this->assertTrue(isset($_SESSION[$container->label()]));

        session_destroy();
    }

    /**
     *
     */
    function test_invoke_start()
    {
        $container = $this->container();

        $start = new Start($container);

        $this->assertEquals(PHP_SESSION_NONE, $container->status());

        @$start();

        $this->assertEquals(PHP_SESSION_ACTIVE, $container->status());

        session_destroy();
    }
}
