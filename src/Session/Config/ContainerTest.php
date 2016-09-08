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
    function test_start_with_reset()
    {
        $container = new Container($this->session());

        @$container->start();

        $this->assertInstanceOf(Model::class, $_SESSION[$container->label()]);

        $container->destroy();
    }

    /**
     *
     */
    function test_start_without_reset()
    {
        @session_start();

        $container = new Container($this->session());

        $model = new Model;

        $_SESSION[$container->label()] = $model;

        $this->assertTrue(@$container->start());

        $container->destroy();
    }
    /**
     *
     */
    function test_start_multiple_containers()
    {
        $app = new Container($this->session(), 'app');

        $this->assertEquals(PHP_SESSION_NONE, $app->status());

        @$app->start();

        $this->assertEquals(PHP_SESSION_ACTIVE, $app->status());

        $this->assertEquals('app', $app->label());

        $this->assertTrue(isset($_SESSION[$app->label()]));

        $mod = new Container($this->session(), 'mod');

        $mod->start();

        $this->assertEquals('mod', $mod->label());

        $this->assertTrue(isset($_SESSION[$mod->label()]));

        $this->assertTrue($_SESSION[$app->label()] !== $_SESSION[$mod->label()]);

        $mod->destroy();
    }

    /**
     *
     */
    function test_invoke_nested_container()
    {
        $app = new Container($this->session(), 'app');

        @$app->start();

        $mod = new Container($app, 'mod');

        $mod->start();

        $this->assertEquals('mod', $mod->label());

        $this->assertTrue(isset($_SESSION[$app->label()][$mod->label()]));

        $mod->set('foo', 'bar');

        $this->assertEquals('bar', $_SESSION[$app->label()][$mod->label()]['foo']);

        $mod->destroy();
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
