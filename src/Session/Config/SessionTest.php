<?php
/**
 *
 */

namespace Mvc5\Test\Session\Config;

use Mvc5\Cookie\Container;
use Mvc5\Cookie\Config as Cookies;
use Mvc5\Session\Config;
use Mvc5\Test\Test\TestCase;

class SessionTest
    extends TestCase
{
    /**
     * @return Config
     */
    protected function session()
    {
        return new Config(new Cookies(new Container));
    }

    /**
     *
     */
    function test_construct()
    {
        $this->assertInstanceOf(Config::class, $this->session());
    }

    /**
     *
     */
    function test_close()
    {
        @session_start();

        $this->assertEquals(PHP_SESSION_ACTIVE, session_status());

        $session = $this->session();

        $session->close();

        $this->assertEquals(PHP_SESSION_NONE, session_status());

        @session_destroy();
    }

    /**
     *
     */
    function test_count()
    {
        @session_start();

        $session = $this->session();

        $session['foo'] = 'bar';

        $this->assertEquals(1, $session->count());

        session_destroy();
    }

    /**
     *
     */
    function test_current()
    {
        @session_start();

        $session = $this->session();

        $session['foo'] = 'bar';

        $this->assertEquals('bar', $session->current());

        session_destroy();
    }

    /**
     *
     */
    function test_destroy()
    {
        @session_start();

        $session = $this->session();

        $this->assertNotEmpty(session_id());

        $session->destroy();

        $this->assertEmpty(session_id());

        @session_destroy();
    }

    /**
     *
     */
    function test_get()
    {
        @session_start();

        $session = $this->session();

        $session['foo'] = 'bar';

        $this->assertEquals('bar', $session->get('foo'));

        session_destroy();
    }

    /**
     *
     */
    function test_has()
    {
        @session_start();

        $session = $this->session();

        $session['foo'] = 'bar';

        $this->assertTrue($session->has('foo'));

        session_destroy();
    }

    /**
     *
     */
    function test_id()
    {
        @session_start();

        $session = $this->session();

        $this->assertEquals(session_id(), $session->id());

        @session_destroy();
    }

    /**
     *
     */
    function test_key()
    {
        @session_start();

        $session = $this->session();

        $session['foo'] = 'bar';

        $this->assertEquals('foo', $session->key());

        session_destroy();
    }

    /**
     *
     */
    function test_name()
    {
        @session_start();

        $session = $this->session();

        $this->assertEquals(session_name(), $session->name());

        @session_destroy();
    }

    /**
     *
     */
    function test_next()
    {
        @session_start();

        $session = $this->session();

        $session['foo'] = 'bar';
        $session['baz'] = 'bat';

        $session->next();

        $this->assertEquals('bat', $session->current());

        session_destroy();
    }

    /**
     *
     */
    function test_offsetGet()
    {
        @session_start();

        $session = $this->session();

        $session['foo'] = 'bar';

        $this->assertEquals('bar', $session['foo']);

        session_destroy();
    }

    /**
     *
     */
    function test_regenerate()
    {
        @session_start();

        $session = $this->session();

        $id = $session->id();

        @$session->regenerate();

        $this->assertEquals(session_id(), $session->id());
        //$this->assertNotEquals($id, $session->id()); //stderr=true

        @session_destroy();
    }

    /**
     *
     */
    function test_remove()
    {
        @session_start();

        $session = $this->session();

        $session['foo'] = 'bar';

        $this->assertEquals('bar', $session['foo']);

        $session->remove('foo');

        $this->assertEmpty($session['foo']);

        session_destroy();
    }

    /**
     *
     */
    function test_rewind()
    {
        @session_start();

        $session = $this->session();

        $session['foo'] = 'bar';
        $session['baz'] = 'bat';

        $session->next();

        $this->assertEquals('bat', $session->current());

        $session->rewind();

        $this->assertEquals('bar', $session->current());

        session_destroy();
    }

    /**
     *
     */
    function test_set()
    {
        @session_start();

        $session = $this->session();

        $session->set('foo', 'bar');

        $this->assertEquals('bar', $session->get('foo'));

        session_destroy();
    }

    /**
     *
     */
    function test_start()
    {
        $session = $this->session();

        $this->assertEquals(PHP_SESSION_NONE, $session->status());

        @$session->start();

        $this->assertEquals(PHP_SESSION_ACTIVE, $session->status());

        $session->destroy();
    }

    /**
     *
     */
    function test_start_ini_settings()
    {
        $session = $this->session();

        $this->assertEquals(PHP_SESSION_NONE, $session->status());

        $this->assertEquals('PHPSESSID', ini_get('session.name'));

        @$session->start(['name' => 'app']);

        $this->assertEquals(PHP_SESSION_ACTIVE, $session->status());

        $this->assertEquals('app', ini_get('session.name'));

        $session->destroy();

        $this->assertEquals('app', ini_get('session.name'));
    }

    /**
     *
     */
    function test_status()
    {
        @session_start();

        $session = $this->session();

        $this->assertEquals(PHP_SESSION_ACTIVE, $session->status());

        @session_destroy();
    }

    /**
     *
     */
    function test_valid()
    {
        @session_start();

        $session = $this->session();

        $session->set('foo', 'bar');

        $this->assertTrue($session->valid());

        session_destroy();
    }

    /**
     *
     */
    function test_with()
    {
        @session_start();

        $session = $this->session();

        $this->assertInstanceOf(Config::class, $session->with('foo', 'bar'));
        $this->assertEquals('bar', $session->get('foo'));

        session_destroy();
    }

    /**
     *
     */
    function test_without()
    {
        @session_start();

        $session = $this->session();

        $session->set('foo', 'bar');

        $this->assertNotEmpty($session->get('foo'));

        $this->assertInstanceOf(Config::class, $session->without('foo'));
        $this->assertEmpty($session->get('foo'));

        session_destroy();
    }

    /**
     *
     */
    function test__get()
    {
        @session_start();

        $session = $this->session();

        $session['foo'] = 'bar';

        $this->assertEquals('bar', $session->foo);

        session_destroy();
    }
}
