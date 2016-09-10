<?php
/**
 *
 */

namespace Mvc5\Test\Session\Config;

use Mvc5\Cookie\Config as Cookies;
use Mvc5\Cookie\Container as CookieContainer;
use Mvc5\Session\Config;
use Mvc5\Session\Container;
use Mvc5\Session\Model;
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
        $container = new Container($this->session());

        @$container->start();

        $this->assertEquals(PHP_SESSION_ACTIVE, $container->status());

        $container->close();

        $this->assertEquals(PHP_SESSION_NONE, $container->status());
    }

    /**
     *
     */
    function test_destroy()
    {
        $container = new Container($this->session());

        @$container->start();

        $this->assertNotEmpty($container->id());

        $container->destroy();

        $this->assertEmpty($container->id());
    }

    /**
     *
     */
    function test_id()
    {
        $container = new Container($this->session());

        $this->assertEmpty($container->id());

        @$container->start();

        $this->assertEquals(session_id(), $container->id());

        $container->destroy();
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
        $container = new Container($this->session());

        $this->assertEquals(session_name(), $container->name());
    }

    /**
     *
     */
    function test_regenerate()
    {
        $container = new Container($this->session());

        @$container->start();

        //$id = $container->id();

        @$container->regenerate();

        $this->assertEquals(session_id(), $container->id());
        //$this->assertNotEquals($id, $container->id()); //stderr=true

        $container->destroy();
    }

    /**
     *
     */
    function test_reset()
    {
        $container = new Container($this->session());

        @$container->start();

        $container['foo'] = 'bar';

        $this->assertEquals(1, $container->count());

        $container->reset();

        $this->assertEquals(0, $container->count());

        $container->destroy();
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

        $this->assertFalse($container->start());
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
        $container = new Container($this->session());

        @session_start();

        $model = new Model;

        $_SESSION[$container->label()] = $model;

        $this->assertTrue($container->start());

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
    function test_start_nested_container()
    {
        $app = new Container($this->session(), 'app');
        $mod = new Container($app, 'mod');

        @$mod->start();

        $this->assertEquals(PHP_SESSION_ACTIVE, $app->status());

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
        $container = new Container($this->session());

        @$container->start();

        $this->assertEquals(PHP_SESSION_ACTIVE, $container->status());

        $container->destroy();
    }

    /**
     *
     */
    function test_with()
    {
        $container = new Container($this->session());

        @$container->start();

        $this->assertTrue($container === $container->with('foo', 'bar'));
        $this->assertEquals('bar', $container->get('foo'));

        $container->destroy();
    }

    /**
     *
     */
    function test_without()
    {
        $container = new Container($this->session());

        @$container->start();

        $container->set('foo', 'bar');

        $this->assertNotEmpty($container->get('foo'));
        $this->assertEquals($container, $container->without('foo'));
        $this->assertEmpty($container->get('foo'));

        $container->destroy();
    }
}
