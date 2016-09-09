<?php
/**
 *
 */

namespace Mvc5\Test\Session\Config;

use Mvc5\Cookie\Config as Cookies;
use Mvc5\Cookie\Container;
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
        $session = $this->session();

        @$session->start();

        $this->assertEquals(PHP_SESSION_ACTIVE, $session->status());

        $session->close();

        $this->assertEquals(PHP_SESSION_NONE, $session->status());
    }

    /**
     *
     */
    function test_count()
    {
        $session = $this->session();

        @$session->start();

        $this->assertEquals(0, $session->count());

        $session['foo'] = 'bar';

        $this->assertEquals(1, $session->count());

        $session->destroy();
    }

    /**
     *
     */
    function test_current()
    {
        $session = $this->session();

        @$session->start();

        $this->assertEquals(null, $session->current());

        $session['foo'] = 'bar';

        $this->assertEquals('bar', $session->current());

        $session->destroy();
    }

    /**
     *
     */
    function test_destroy()
    {
        $session = $this->session();

        @$session->start();

        $this->assertNotEmpty($session->id());

        $session->destroy();

        $this->assertEmpty($session->id());
    }

    /**
     *
     */
    function test_get()
    {
        $session = $this->session();

        @$session->start();

        $session['foo'] = 'bar';

        $this->assertEquals('bar', $session->get('foo'));

        $session->destroy();
    }

    /**
     *
     */
    function test_has()
    {
        $session = $this->session();

        @$session->start();

        $session['foo'] = 'bar';

        $this->assertTrue($session->has('foo'));

        $session->destroy();
    }

    /**
     *
     */
    function test_id()
    {
        $session = $this->session();

        @$session->start();

        $this->assertEquals(session_id(), $session->id());

        $session->destroy();
    }

    /**
     *
     */
    function test_key()
    {
        $session = $this->session();

        @$session->start();

        $session['foo'] = 'bar';

        $this->assertEquals('foo', $session->key());

        $session->destroy();
    }

    /**
     *
     */
    function test_name()
    {
        $session = $this->session();

        @$session->start();

        $this->assertEquals(session_name(), $session->name());

        $session->destroy();
    }

    /**
     *
     */
    function test_next()
    {
        $session = $this->session();

        @$session->start();

        $session['foo'] = 'bar';
        $session['baz'] = 'bat';

        $session->next();

        $this->assertEquals('bat', $session->current());

        $session->destroy();
    }

    /**
     *
     */
    function test_offsetGet()
    {
        $session = $this->session();

        @$session->start();

        $session['foo'] = 'bar';

        $this->assertEquals('bar', $session['foo']);

        $session->destroy();
    }

    /**
     *
     */
    function test_regenerate()
    {
        $session = $this->session();

        @$session->start();

        //$id = $session->id();

        @$session->regenerate();

        $this->assertEquals(session_id(), $session->id());
        //$this->assertNotEquals($id, $session->id()); //stderr=true

        $session->destroy();
    }

    /**
     *
     */
    function test_remove()
    {
        $session = $this->session();

        @$session->start();

        $session['foo'] = 'bar';

        $this->assertEquals('bar', $session['foo']);

        $session->remove('foo');

        $this->assertEmpty($session['foo']);

        $session->destroy();
    }

    /**
     *
     */
    function test_rewind()
    {
        $session = $this->session();

        @$session->start();

        $session['foo'] = 'bar';
        $session['baz'] = 'bat';

        $session->next();

        $this->assertEquals('bat', $session->current());

        $session->rewind();

        $this->assertEquals('bar', $session->current());

        $session->destroy();
    }

    /**
     *
     */
    function test_set()
    {
        $session = $this->session();

        @$session->start();

        $session->set('foo', 'bar');

        $this->assertEquals('bar', $session->get('foo'));

        $session->destroy();
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
    function test_start_already_active()
    {
        $session = $this->session();

        $this->assertEquals(PHP_SESSION_NONE, $session->status());

        @session_start();

        $this->assertEquals(PHP_SESSION_ACTIVE, $session->status());

        $this->assertTrue($session->start());

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
        $session = $this->session();

        @$session->start();

        $this->assertEquals(PHP_SESSION_ACTIVE, $session->status());

        $session->destroy();
    }

    /**
     *
     */
    function test_valid()
    {
        $session = $this->session();

        @$session->start();

        $session->set('foo', 'bar');

        $this->assertTrue($session->valid());

        $session->destroy();
    }

    /**
     *
     */
    function test_with()
    {
        $session = $this->session();

        @$session->start();

        $this->assertTrue($session === $session->with('foo', 'bar'));
        $this->assertEquals('bar', $session->get('foo'));

        $session->destroy();
    }

    /**
     *
     */
    function test_without()
    {
        $session = $this->session();

        @$session->start();

        $session->set('foo', 'bar');

        $this->assertNotEmpty($session->get('foo'));
        $this->assertEquals($session, $session->without('foo'));
        $this->assertEmpty($session->get('foo'));

        $session->destroy();
    }

    /**
     *
     */
    function test__get()
    {
        $session = $this->session();

        @$session->start();

        $session['foo'] = 'bar';

        $this->assertEquals('bar', $session->foo);

        $session->destroy();
    }
}
