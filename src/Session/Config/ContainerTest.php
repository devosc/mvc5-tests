<?php
/**
 *
 */

namespace Mvc5\Test\Session\Config;

use Mvc5\Cookie\Config as Cookies;
use Mvc5\Cookie\Container as CookieContainer;
use Mvc5\Session\Config as Session;
use Mvc5\Session\Container;
use Mvc5\Session\Model;
use Mvc5\Test\Test\TestCase;

class ContainerTest
    extends TestCase
{
    /**
     *
     */
    function test_construct()
    {
        $container = new Container(new Session, 'app');

        $this->assertEquals('app', $container->label());
    }

    /**
     *
     */
    function test_abort()
    {
        $container = new Container(new Session, 'app');

        @$container->start();

        $this->assertEquals(PHP_SESSION_ACTIVE, $container->status());

        $container['foo'] = 'bar';

        $this->assertEquals('bar', $container->get('foo'));
        $this->assertEquals('bar', $_SESSION['app']['foo']);

        $container->close();

        $this->assertEquals(PHP_SESSION_NONE, $container->status());

        @$container->start();

        $container['foo'] = 'baz';

        $this->assertEquals('baz', $container->get('foo'));
        $this->assertEquals('baz', $_SESSION['app']['foo']);

        $container->abort();

        $this->assertEquals('baz', $container->get('foo'));
        $this->assertEquals('baz', $_SESSION['app']['foo']);

        @$container->start();

        $this->assertEquals('bar', $container->get('foo'));
        $this->assertEquals('bar', $_SESSION['app']['foo']);

        $container->destroy(false);
    }

    /**
     *
     */
    function test_clear()
    {
        $container = new Container(new Session);

        @$container->start();

        $container['foo'] = 'bar';

        $this->assertEquals(1, $container->count());

        $container->clear();

        $this->assertEquals(0, $container->count());

        $container->destroy(false);
    }

    /**
     *
     */
    function test_close()
    {
        $container = new Container(new Session);

        @$container->start();

        $this->assertEquals(PHP_SESSION_ACTIVE, $container->status());

        $container->close();

        $this->assertEquals(PHP_SESSION_NONE, $container->status());
    }

    /**
     *
     */
    function test_destroy_without_removing_cookie()
    {
        $container = new Container(new Session);

        @$container->start();

        $this->assertNotEmpty($container->id());

        $container->destroy(false);

        $this->assertEmpty($container->id());
    }

    /**
     *
     */
    function test_destroy_with_cookie_container()
    {
        $container = new Container(new Session(new Cookies(new CookieContainer)));

        @$container->start();

        $this->assertNotEmpty($container->id());

        $container->destroy();

        $this->assertEmpty($container->id());
    }

    /**
     *
     */
    function test_destroy_without_cookie_container()
    {
        $container = new Container(new Session);

        @$container->start();

        $this->assertNotEmpty($container->id());

        @$container->destroy();

        $this->assertEmpty($container->id());
    }

    /**
     *
     */
    function test_id()
    {
        $container = new Container(new Session);

        $this->assertEmpty($container->id());

        @$container->start();

        $this->assertEquals(session_id(), $container->id());

        $container->destroy(false);
    }

    /**
     *
     */
    function test_id_new()
    {
        $container = new Container(new Session);

        $this->assertEquals($container->id(), $container->id('foo'));

        @$container->start();

        $this->assertEquals(session_id(), $container->id());
        $this->assertEquals('foo', $container->id());

        $container->destroy(false);
    }

    /**
     *
     */
    function test_label()
    {
        $container = new Container(new Session, 'app');

        $this->assertEquals('app', $container->label());
    }

    /**
     *
     */
    function test_name()
    {
        $container = new Container(new Session);

        $this->assertEquals(session_name(), $container->name());
    }

    /**
     *
     */
    function test_name_new()
    {
        $container = new Container(new Session);

        $current = $container->name();

        $this->assertEquals($current, $container->name('foo'));

        $container->name($current);
    }

    /**
     *
     */
    function test_regenerate()
    {
        $container = new Container(new Session);

        @$container->start();

        //$id = $container->id();

        @$container->regenerate();

        $this->assertEquals(session_id(), $container->id());
        //$this->assertNotEquals($id, $container->id()); //stderr=true

        $container->destroy(false);
    }

    /**
     *
     */
    function test_reset()
    {
        $container = new Container(new Session, 'app');

        @$container->start();

        $this->assertEquals(PHP_SESSION_ACTIVE, $container->status());

        $container['foo'] = 'bar';

        $this->assertEquals('bar', $container->get('foo'));
        $this->assertEquals('bar', $_SESSION['app']['foo']);

        $container->close();

        $this->assertEquals(PHP_SESSION_NONE, $container->status());

        @$container->start();

        $container['foo'] = 'baz';

        $this->assertEquals('baz', $container->get('foo'));
        $this->assertEquals('baz', $_SESSION['app']['foo']);

        $container->reset();

        $this->assertEquals('bar', $container->get('foo'));
        $this->assertEquals('bar', $_SESSION['app']['foo']);

        $container->destroy(false);
    }

    /**
     *
     */
    function test_start()
    {
        $container = new Container(new Session);

        $this->assertEquals(PHP_SESSION_NONE, $container->status());

        @$container->start();

        $this->assertEquals(PHP_SESSION_ACTIVE, $container->status());

        $container->destroy(false);
    }

    /**
     *
     */
    function test_start_invalid()
    {
        $container = new Container(new Invalid);

        $this->assertFalse($container->start());
    }

    /**
     *
     */
    function test_start_with_reset()
    {
        $container = new Container(new Session);

        @$container->start();

        $this->assertInstanceOf(Model::class, $_SESSION[$container->label()]);

        $container->destroy(false);
    }

    /**
     *
     */
    function test_start_without_reset()
    {
        $container = new Container(new Session);

        @session_start();

        $model = new Model;

        $_SESSION[$container->label()] = $model;

        $this->assertTrue($container->start());

        $container->destroy(false);
    }
    /**
     *
     */
    function test_start_multiple_containers()
    {
        $app = new Container(new Session, 'app');

        $this->assertEquals(PHP_SESSION_NONE, $app->status());

        @$app->start();

        $this->assertEquals(PHP_SESSION_ACTIVE, $app->status());
        $this->assertEquals('app', $app->label());
        $this->assertTrue(isset($_SESSION['app']));

        $mod = new Container(new Session, 'mod');

        $mod->start();

        $this->assertEquals('mod', $mod->label());
        $this->assertTrue(isset($_SESSION['mod']));
        $this->assertTrue($_SESSION['app'] !== $_SESSION['mod']);

        $mod->destroy(false);
    }

    /**
     *
     */
    function test_start_nested_container()
    {
        $app = new Container(new Session, 'app');
        $mod = new Container($app, 'mod');

        @$mod->start();

        $this->assertEquals(PHP_SESSION_ACTIVE, $app->status());
        $this->assertEquals('mod', $mod->label());
        $this->assertTrue(isset($_SESSION['app']['mod']));

        $mod->set('foo', 'bar');

        $this->assertEquals('bar', $_SESSION['app']['mod']['foo']);

        $mod->destroy(false);
    }

    /**
     *
     */
    function test_status()
    {
        $container = new Container(new Session);

        @$container->start();

        $this->assertEquals(PHP_SESSION_ACTIVE, $container->status());

        $container->destroy(false);
    }

    /**
     *
     */
    function test_with()
    {
        $container = new Container(new Session);

        @$container->start();

        $this->assertTrue($container === $container->with('foo', 'bar'));
        $this->assertEquals('bar', $container->get('foo'));

        $container->destroy(false);
    }

    /**
     *
     */
    function test_without()
    {
        $container = new Container(new Session);

        @$container->start();

        $container->set('foo', 'bar');

        $this->assertNotEmpty($container->get('foo'));
        $this->assertEquals($container, $container->without('foo'));
        $this->assertEmpty($container->get('foo'));

        $container->destroy(false);
    }
}
