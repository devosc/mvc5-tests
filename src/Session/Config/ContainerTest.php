<?php
/**
 *
 */

namespace Mvc5\Test\Session\Config;

use Mvc5\Cookie\Container as CookieContainer;
use Mvc5\Cookie\Config as Cookies;
use Mvc5\Model\Config as Model;
use Mvc5\Session\Config;
use Mvc5\Session\Container;
use Mvc5\Test\Session\Invalid;
use Mvc5\Test\Test\TestCase;

class ContainerTest
    extends TestCase
{
    /**
     * @return Config
     */
    protected function session()
    {
        return new Config(new Cookies(new CookieContainer));
    }

    /**
     *
     */
    function test_construct()
    {
        $container = new Container($this->session(), 'app');

        $this->assertEquals('app', $container->label());
    }

    /**
     *
     */
    function test_close()
    {
        @session_start();

        $this->assertEquals(PHP_SESSION_ACTIVE, session_status());

        $container = new Container($this->session());

        $container->close();

        $this->assertEquals(PHP_SESSION_NONE, session_status());

        @session_destroy();
    }

    /**
     *
     */
    function test_destroy()
    {
        @session_start();

        $container = new Container($this->session());

        $this->assertNotEmpty(session_id());

        $container->destroy();

        $this->assertEmpty(session_id());

        @session_destroy();
    }

    /**
     *
     */
    function test_id()
    {
        @session_start();

        $container = new Container($this->session());

        $this->assertEquals(session_id(), $container->id());

        @session_destroy();
    }

    /**
     *
     */
    function test_label()
    {
        $container = new Container($this->session(), 'app');

        $this->assertEquals('app', $container->label());
    }

    /**
     *
     */
    function test_name()
    {
        @session_start();

        $container = new Container($this->session());

        $this->assertEquals(session_name(), $container->name());

        @session_destroy();
    }

    /**
     *
     */
    function test_regenerate()
    {
        @session_start();

        $container = new Container($this->session());

        $id = $container->id();

        @$container->regenerate();

        $this->assertEquals(session_id(), $container->id());
        //$this->assertNotEquals($id, $container->id()); //stderr=true

        @session_destroy();
    }

    /**
     *
     */
    function test_register_with_reset()
    {
        @session_start();

        $container = new Container($this->session());

        $this->assertFalse(isset($_SESSION[$container->label()]));

        $container->register();

        $this->assertInstanceOf(Model::class, $_SESSION[$container->label()]);

        @session_destroy();
    }

    /**
     *
     */
    function test_register_without_reset()
    {
        @session_start();

        $container = new Container($this->session());

        $this->assertFalse(isset($_SESSION[$container->label()]));

        $model = new Model;

        $_SESSION[$container->label()] = $model;

        $container->register();

        $container->set('foo', 'bar');

        $this->assertEquals('bar', $model->get('foo'));

        @session_destroy();
    }

    /**
     *
     */
    function test_reset()
    {
        @session_start();

        $container = new Container($this->session());

        $container['foo'] = 'bar';

        $this->assertEquals(1, $container->count());

        $container->reset();

        $this->assertEquals(0, $container->count());

        session_destroy();
    }

    /**
     *
     */
    function test_start()
    {
        $container = new Container($this->session());

        $this->assertEquals(PHP_SESSION_NONE, $container->status());

        @$container->start();

        $this->assertEquals(PHP_SESSION_ACTIVE, $container->status());

        $container->destroy();
    }

    /**
     *
     */
    function test_start_invalid()
    {
        $container = new Container(new Invalid(new Cookies(new CookieContainer)));

        $this->assertFalse(@$container->start());
    }

    /**
     *
     */
    function test_status()
    {
        @session_start();

        $container = new Container($this->session());

        $this->assertEquals(PHP_SESSION_ACTIVE, $container->status());

        @session_destroy();
    }

    /**
     *
     */
    function test_with()
    {
        @session_start();

        $container = new Container($this->session());

        $this->assertInstanceOf(Container::class, $container->with('foo', 'bar'));
        $this->assertEquals('bar', $container->get('foo'));

        session_destroy();
    }

    /**
     *
     */
    function test_without()
    {
        @session_start();

        $container = new Container($this->session());

        $container->set('foo', 'bar');

        $this->assertNotEmpty($container->get('foo'));

        $this->assertInstanceOf(Container::class, $container->without('foo'));
        $this->assertEmpty($container->get('foo'));

        session_destroy();
    }
}
