<?php
/**
 *
 */

namespace Mvc5\Test\Session;

use Mvc5\Session\Container;
use Mvc5\Session\Model;
use Mvc5\Session\PHPSession;
use Mvc5\Test\Test\TestCase;

/**
 * @runTestsInSeparateProcesses 
 */
class ContainerTest
    extends TestCase
{
    /**
     *
     */
    function test_clear()
    {
        $container = new Container(new PHPSession);

        $container->start();

        $container['foo'] = 'bar';

        $this->assertEquals(1, $container->count());

        $container->clear();

        $this->assertEquals(0, $container->count());

        $container->destroy();
    }

    /**
     *
     */
    function test_close()
    {
        $container = new Container(new PHPSession);

        $container->start();

        $this->assertEquals(PHP_SESSION_ACTIVE, $container->status());

        $container->close();

        $this->assertEquals(PHP_SESSION_NONE, $container->status());
    }

    /**
     *
     */
    function test_destroy_with_cookie_container()
    {
        $container = new Container(new PHPSession);

        $container->start();

        $this->assertNotEmpty($container->id());

        $container->destroy();

        $this->assertEmpty($container->id());
    }

    /**
     *
     */
    function test_destroy_without_cookie_container()
    {
        $container = new Container(new PHPSession);

        $container->start();

        $this->assertNotEmpty($container->id());

        $container->destroy();

        $this->assertEmpty($container->id());
    }

    /**
     *
     */
    function test_destroy_without_removing_cookie()
    {
        $container = new Container(new PHPSession);

        $container->start();

        $this->assertNotEmpty($container->id());

        $container->destroy(false);

        $this->assertEmpty($container->id());
    }

    /**
     *
     */
    function test_id()
    {
        $container = new Container(new PHPSession);

        $this->assertEmpty($container->id());

        $container->start();

        $this->assertEquals(session_id(), $container->id());

        $container->destroy();
    }

    /**
     *
     */
    function test_id_new()
    {
        $container = new Container(new PHPSession);

        $this->assertEquals($container->id(), $container->id('foo'));

        $container->start();

        $this->assertEquals(session_id(), $container->id());
        $this->assertEquals('foo', $container->id());

        $container->destroy();
    }

    /**
     *
     */
    function test_label()
    {
        $container = new Container(new PHPSession, 'app');

        $this->assertEquals('app', $container->label());
    }

    /**
     *
     */
    function test_name()
    {
        $container = new Container(new PHPSession);

        $this->assertEquals(session_name(), $container->name());
    }

    /**
     *
     */
    function test_name_new()
    {
        $container = new Container(new PHPSession);

        $current = $container->name();

        $this->assertEquals($current, $container->name('foo'));

        $container->name($current);
    }

    /**
     *
     */
    function test_regenerate()
    {
        $container = new Container(new PHPSession);

        $container->start();

        //$id = $container->id();

        $container->regenerate();

        $this->assertEquals(session_id(), $container->id());
        //$this->assertNotEquals($id, $container->id()); //stderr=true

        $container->destroy();
    }

    /**
     *
     */
    function test_start()
    {
        $container = new Container(new PHPSession);

        $this->assertEquals(PHP_SESSION_NONE, $container->status());

        $container->start();

        $this->assertEquals(PHP_SESSION_ACTIVE, $container->status());

        $container->destroy();
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
    function test_start_multiple_containers()
    {
        $app = new Container(new PHPSession, 'app');

        $this->assertEquals(PHP_SESSION_NONE, $app->status());

        $app->start();

        $this->assertEquals(PHP_SESSION_ACTIVE, $app->status());
        $this->assertEquals('app', $app->label());
        $this->assertTrue(isset($_SESSION['app']));

        $mod = new Container(new PHPSession, 'mod');

        $mod->start();

        $this->assertEquals('mod', $mod->label());
        $this->assertTrue(isset($_SESSION['mod']));
        $this->assertTrue($_SESSION['app'] !== $_SESSION['mod']);

        $mod->destroy();
    }

    /**
     *
     */
    function test_start_nested_container()
    {
        $app = new Container(new PHPSession, 'app');
        $mod = new Container($app, 'mod');

        $mod->start();

        $this->assertEquals(PHP_SESSION_ACTIVE, $app->status());
        $this->assertEquals('mod', $mod->label());
        $this->assertTrue(isset($_SESSION['app']['mod']));

        $mod->set('foo', 'bar');

        $this->assertEquals('bar', $_SESSION['app']['mod']['foo']);

        $mod->destroy();
    }

    /**
     *
     */
    function test_start_with_reset_session_model()
    {
        $container = new Container(new PHPSession);

        $container->start();

        $this->assertInstanceOf(Model::class, $_SESSION[$container->label()]);

        $container->destroy();
    }

    /**
     *
     */
    function test_start_without_resetting_session_model()
    {
        $container = new Container(new PHPSession);

        session_start();

        $model = new Model;

        $_SESSION[$container->label()] = $model;

        $this->assertTrue($container->start());

        $container->destroy();
    }

    /**
     *
     */
    function test_status()
    {
        $container = new Container(new PHPSession);

        $container->start();

        $this->assertEquals(PHP_SESSION_ACTIVE, $container->status());

        $container->destroy();
    }

    /**
     *
     */
    function test_with()
    {
        $container = new Container(new PHPSession);

        $container->start();

        $this->assertTrue($container === $container->with('foo', 'bar'));
        $this->assertEquals('bar', $container->get('foo'));

        $container->destroy();
    }

    /**
     *
     */
    function test_without()
    {
        $container = new Container(new PHPSession);

        $container->start();

        $container->set('foo', 'bar');

        $this->assertNotEmpty($container->get('foo'));
        $this->assertEquals($container, $container->without('foo'));
        $this->assertEmpty($container->get('foo'));

        $container->destroy();
    }
}
