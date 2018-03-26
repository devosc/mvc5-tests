<?php
/**
 *
 */

namespace Mvc5\Test\Session;

use Mvc5\Session\PHPSession;
use Mvc5\Test\Test\TestCase;

/**
 * @runTestsInSeparateProcesses 
 */
class SessionTest
    extends TestCase
{
    /**
     *
     */
    function test_clear()
    {
        $session = new PHPSession;

        $session->start();

        $session['foo'] = 'bar';

        $this->assertEquals(1, $session->count());

        $session->clear();

        $this->assertEquals(0, $session->count());

        $session->destroy();
    }

    /**
     *
     */
    function test_close()
    {
        $session = new PHPSession;

        $session->start();

        $this->assertEquals(PHP_SESSION_ACTIVE, $session->status());

        $session->close();

        $this->assertEquals(PHP_SESSION_NONE, $session->status());
    }

    /**
     *
     */
    function test_count()
    {
        $session = new PHPSession;

        $session->start();

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
        $session = new PHPSession;

        $session->start();

        $this->assertFalse($session->current());

        $session['foo'] = 'bar';

        $this->assertEquals('bar', $session->current());

        $session->destroy();
    }

    /**
     *
     */
    function test_destroy_with_cookie_container()
    {
        $session = new PHPSession;

        $session->start();

        $this->assertNotEmpty($session->id());

        $session->destroy();

        $this->assertEmpty($session->id());
    }

    /**
     *
     */
    function test_destroy_without_cookie_container()
    {
        $session = new PHPSession;

        $session->start();

        $this->assertNotEmpty($session->id());

        $session->destroy();

        $this->assertEmpty($session->id());
    }

    /**
     *
     */
    function test_destroy_without_removing_cookie()
    {
        $session = new PHPSession;

        $session->start();

        $this->assertNotEmpty($session->id());

        $session->destroy(false);

        $this->assertEmpty($session->id());
    }

    /**
     *
     */
    function test_get()
    {
        $session = new PHPSession;

        $session->start();

        $session['foo'] = 'bar';
        $session['baz'] = 'bat';

        $this->assertEquals('bar', $session->get('foo'));
        $this->assertEquals(['foo' => 'bar', 'baz' => 'bat'], $session->get(['foo', 'baz']));

        $session->destroy();
    }

    /**
     *
     */
    function test_has()
    {
        $session = new PHPSession;

        $session->start();

        $session['foo'] = 'bar';
        $session['bar'] = 'baz';

        $this->assertTrue($session->has('foo'));
        $this->assertTrue($session->has(['foo', 'bar']));
        $this->assertFalse($session->has(['foo', 'bar', 'foobar']));

        $session->destroy();
    }

    /**
     *
     */
    function test_id()
    {
        $session = new PHPSession;

        $session->start();

        $this->assertEquals(session_id(), $session->id());

        $session->destroy(false);
    }

    /**
     *
     */
    function test_id_new()
    {
        $session = new PHPSession;

        $this->assertEmpty($session->id());

        $session->id('foo');

        $session->start();

        $this->assertEquals(session_id(), $session->id());
        $this->assertEquals('foo', $session->id());

        $session->destroy();
    }

    /**
     *
     */
    function test_key()
    {
        $session = new PHPSession;

        $session->start();

        $session['foo'] = 'bar';

        $this->assertEquals('foo', $session->key());

        $session->destroy();
    }

    /**
     *
     */
    function test_name()
    {
        $session = new PHPSession;

        $session->start();

        $this->assertEquals(session_name(), $session->name());

        $session->destroy();
    }

    /**
     *
     */
    function test_name_new()
    {
        $session = new PHPSession;

        $current = $session->name();

        $this->assertEquals($current, $session->name('foo'));

        $session->name($current);
    }

    /**
     *
     */
    function test_next()
    {
        $session = new PHPSession;

        $session->start();

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
        $session = new PHPSession;

        $session->start();

        $session['foo'] = 'bar';

        $this->assertEquals('bar', $session['foo']);

        $session->destroy();
    }

    /**
     *
     */
    function test_regenerate()
    {
        $session = new PHPSession;

        $session->start();

        //$id = $session->id();

        $session->regenerate();

        $this->assertEquals(session_id(), $session->id());
        //$this->assertNotEquals($id, $session->id()); //stderr=true

        $session->destroy();
    }

    /**
     *
     */
    function test_remove()
    {
        $session = new PHPSession;

        $session->start();

        $session['foo'] = 'bar';

        $this->assertEquals('bar', $session['foo']);

        $session->remove('foo');

        $this->assertEmpty($session['foo']);

        $session->destroy();
    }

    /**
     *
     */
    function test_remove_array()
    {
        $session = new PHPSession;

        $session->start();

        $session->set(['foo' => 'bar', 'baz' => 'bat']);

        $this->assertEquals('bar', $session['foo']);
        $this->assertEquals('bat', $session['baz']);

        $session->remove(['foo', 'baz']);

        $this->assertEmpty($session['foo']);
        $this->assertEmpty($session['baz']);

        $session->destroy();
    }

    /**
     *
     */
    function test_rewind()
    {
        $session = new PHPSession;

        $session->start();

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
        $session = new PHPSession;

        $session->start();

        $session->set('foo', 'bar');

        $this->assertEquals('bar', $session->get('foo'));

        $session->destroy();
    }

    /**
     *
     */
    function test_set_array()
    {
        $session = new PHPSession;

        $session->start();

        $session->set(['foo' => 'bar', 'baz' => 'bat']);

        $this->assertEquals('bar', $session->get('foo'));
        $this->assertEquals('bat', $session->get('baz'));

        $session->destroy();
    }

    /**
     *
     */
    function test_start()
    {
        $session = new PHPSession;

        $this->assertEquals(PHP_SESSION_NONE, $session->status());

        $session->start();

        $this->assertEquals(PHP_SESSION_ACTIVE, $session->status());

        $session->destroy();
    }

    /**
     *
     */
    function test_start_already_active()
    {
        $session = new PHPSession;

        $this->assertEquals(PHP_SESSION_NONE, $session->status());

        session_start();

        $this->assertEquals(PHP_SESSION_ACTIVE, $session->status());
        $this->assertTrue($session->start());

        $session->destroy();
    }

    /**
     *
     */
    function test_start_ini_settings()
    {
        $session = new PHPSession;

        $this->assertEquals(PHP_SESSION_NONE, $session->status());
        $this->assertEquals('PHPSESSID', ini_get('session.name'));

        $session->start(['name' => 'app']);

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
        $session = new PHPSession;

        $session->start();

        $this->assertEquals(PHP_SESSION_ACTIVE, $session->status());

        $session->destroy();
    }

    /**
     *
     */
    function test_valid()
    {
        $session = new PHPSession;

        $session->start();

        $session->set('foo', 'bar');

        $this->assertTrue($session->valid());

        $session->destroy();
    }

    /**
     *
     */
    function test_with()
    {
        $session = new PHPSession;

        $session->start();

        $this->assertTrue($session === $session->with('foo', 'bar'));
        $this->assertEquals('bar', $session->get('foo'));

        $session->destroy();
    }

    /**
     *
     */
    function test_without()
    {
        $session = new PHPSession;

        $session->start();

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
        $session = new PHPSession;

        $session->start();

        $session['foo'] = 'bar';

        $this->assertEquals('bar', $session->foo);

        $session->destroy();
    }
}
