<?php
/**
 *
 */

namespace Mvc5\Test\Session\Config;

use Mvc5\Cookie\Config as Cookies;
use Mvc5\Cookie\Container;
use Mvc5\Session\Config as Session;
use Mvc5\Test\Test\TestCase;

class SessionTest
    extends TestCase
{
    /**
     *
     */
    function test_clear()
    {
        $session = new Session;

        @$session->start();

        $session['foo'] = 'bar';

        $this->assertEquals(1, $session->count());

        $session->clear();

        $this->assertEquals(0, $session->count());

        $session->destroy(false);
    }

    /**
     *
     */
    function test_close()
    {
        $session = new Session;

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
        $session = new Session;

        @$session->start();

        $this->assertEquals(0, $session->count());

        $session['foo'] = 'bar';

        $this->assertEquals(1, $session->count());

        $session->destroy(false);
    }

    /**
     *
     */
    function test_current()
    {
        $session = new Session;

        @$session->start();

        $this->assertEquals(null, $session->current());

        $session['foo'] = 'bar';

        $this->assertEquals('bar', $session->current());

        $session->destroy(false);
    }

    /**
     *
     */
    function test_destroy_without_removing_cookie()
    {
        $session = new Session;

        @$session->start();

        $this->assertNotEmpty($session->id());

        $session->destroy(false);

        $this->assertEmpty($session->id());
    }

    /**
     *
     */
    function test_destroy_with_cookie_container()
    {
        $session = new Session(new Cookies(new Container));

        @$session->start();

        $this->assertNotEmpty($session->id());

        $session->destroy();

        $this->assertEmpty($session->id());
    }

    /**
     *
     */
    function test_destroy_without_cookie_container()
    {
        $session = new Session;

        @$session->start();

        $this->assertNotEmpty($session->id());

        @$session->destroy();

        $this->assertEmpty($session->id());
    }

    /**
     *
     */
    function test_get()
    {
        $session = new Session;

        @$session->start();

        $session['foo'] = 'bar';

        $this->assertEquals('bar', $session->get('foo'));

        $session->destroy(false);
    }

    /**
     *
     */
    function test_has()
    {
        $session = new Session;

        @$session->start();

        $session['foo'] = 'bar';

        $this->assertTrue($session->has('foo'));

        $session->destroy(false);
    }

    /**
     *
     */
    function test_id()
    {
        $session = new Session;

        @$session->start();

        $this->assertEquals(session_id(), $session->id());

        $session->destroy(false);
    }

    /**
     *
     */
    function test_id_new()
    {
        $session = new Session;

        $this->assertEmpty($session->id());

        $session->id('foo');

        @$session->start();

        $this->assertEquals(session_id(), $session->id());
        $this->assertEquals('foo', $session->id());

        $session->destroy(false);
    }

    /**
     *
     */
    function test_key()
    {
        $session = new Session;

        @$session->start();

        $session['foo'] = 'bar';

        $this->assertEquals('foo', $session->key());

        $session->destroy(false);
    }

    /**
     *
     */
    function test_name()
    {
        $session = new Session;

        @$session->start();

        $this->assertEquals(session_name(), $session->name());

        $session->destroy(false);
    }

    /**
     *
     */
    function test_name_new()
    {
        $session = new Session;

        $current = $session->name();

        $this->assertEquals($current, $session->name('foo'));

        $session->name($current);
    }

    /**
     *
     */
    function test_next()
    {
        $session = new Session;

        @$session->start();

        $session['foo'] = 'bar';
        $session['baz'] = 'bat';

        $session->next();

        $this->assertEquals('bat', $session->current());

        $session->destroy(false);
    }

    /**
     *
     */
    function test_offsetGet()
    {
        $session = new Session;

        @$session->start();

        $session['foo'] = 'bar';

        $this->assertEquals('bar', $session['foo']);

        $session->destroy(false);
    }

    /**
     *
     */
    function test_regenerate()
    {
        $session = new Session;

        @$session->start();

        //$id = $session->id();

        @$session->regenerate();

        $this->assertEquals(session_id(), $session->id());
        //$this->assertNotEquals($id, $session->id()); //stderr=true

        $session->destroy(false);
    }

    /**
     *
     */
    function test_remove()
    {
        $session = new Session;

        @$session->start();

        $session['foo'] = 'bar';

        $this->assertEquals('bar', $session['foo']);

        $session->remove('foo');

        $this->assertEmpty($session['foo']);

        $session->destroy(false);
    }

    /**
     *
     */
    function test_rewind()
    {
        $session = new Session;

        @$session->start();

        $session['foo'] = 'bar';
        $session['baz'] = 'bat';

        $session->next();

        $this->assertEquals('bat', $session->current());

        $session->rewind();

        $this->assertEquals('bar', $session->current());

        $session->destroy(false);
    }

    /**
     *
     */
    function test_set()
    {
        $session = new Session;

        @$session->start();

        $session->set('foo', 'bar');

        $this->assertEquals('bar', $session->get('foo'));

        $session->destroy(false);
    }

    /**
     *
     */
    function test_start()
    {
        $session = new Session;

        $this->assertEquals(PHP_SESSION_NONE, $session->status());

        @$session->start();

        $this->assertEquals(PHP_SESSION_ACTIVE, $session->status());

        $session->destroy(false);
    }

    /**
     *
     */
    function test_start_already_active()
    {
        $session = new Session;

        $this->assertEquals(PHP_SESSION_NONE, $session->status());

        @session_start();

        $this->assertEquals(PHP_SESSION_ACTIVE, $session->status());
        $this->assertTrue($session->start());

        $session->destroy(false);
    }

    /**
     *
     */
    function test_start_ini_settings()
    {
        $session = new Session;

        $this->assertEquals(PHP_SESSION_NONE, $session->status());
        $this->assertEquals('PHPSESSID', ini_get('session.name'));

        @$session->start(['name' => 'app']);

        $this->assertEquals(PHP_SESSION_ACTIVE, $session->status());
        $this->assertEquals('app', ini_get('session.name'));

        $session->destroy(false);

        $this->assertEquals('app', ini_get('session.name'));
    }

    /**
     *
     */
    function test_status()
    {
        $session = new Session;

        @$session->start();

        $this->assertEquals(PHP_SESSION_ACTIVE, $session->status());

        $session->destroy(false);
    }

    /**
     *
     */
    function test_valid()
    {
        $session = new Session;

        @$session->start();

        $session->set('foo', 'bar');

        $this->assertTrue($session->valid());

        $session->destroy(false);
    }

    /**
     *
     */
    function test_with()
    {
        $session = new Session;

        @$session->start();

        $this->assertTrue($session === $session->with('foo', 'bar'));
        $this->assertEquals('bar', $session->get('foo'));

        $session->destroy(false);
    }

    /**
     *
     */
    function test_without()
    {
        $session = new Session;

        @$session->start();

        $session->set('foo', 'bar');

        $this->assertNotEmpty($session->get('foo'));
        $this->assertEquals($session, $session->without('foo'));
        $this->assertEmpty($session->get('foo'));

        $session->destroy(false);
    }

    /**
     *
     */
    function test__get()
    {
        $session = new Session;

        @$session->start();

        $session['foo'] = 'bar';

        $this->assertEquals('bar', $session->foo);

        $session->destroy(false);
    }
}
