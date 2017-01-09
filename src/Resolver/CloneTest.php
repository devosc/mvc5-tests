<?php
/**
 *
 */

namespace Mvc5\Test\Resolver;

use Mvc5\App;
use Mvc5\Arg;
use Mvc5\Config;
use Mvc5\Test\Test\TestCase;

class CloneTest
    extends TestCase
{
    /**
     *
     */
    function test_container_array()
    {
        $app = new App;

        $a = new \stdClass;
        $a->b = 'b';

        $app->container(['a' => $a]);

        $clone = clone $app;

        $this->assertTrue($clone == $app);
        $this->assertInstanceOf(\stdClass::class, $clone->get('a'));
        $this->assertEquals($a, $clone->get('a'));
        $this->assertTrue($a === $clone->get('a'));
    }

    /**
     *
     */
    function test_scope_object()
    {
        $app = new App(null, null, new Config);

        $clone = clone $app;

        $this->assertTrue(is_object($clone->scope()));
        $this->assertTrue($clone->scope() !== $app->scope());
    }

    /**
     *
     */
    function test_with_arrays()
    {
        $app = new App;

        $clone = clone $app;

        $this->assertTrue($clone == $app);

        $clone->config(['foo' => 'bar']);
        $clone->set('a', 'a');
        $clone->events(['b' => 'b']);
        $clone->configure('baz', 'bat');

        $this->assertFalse($clone == $app);

        $this->assertEquals([], $app->config());
        $this->assertEquals([], $app->events());
        $this->assertEquals([], $app->container());
        $this->assertEquals([], $app->services());
        $this->assertEquals(['foo' => 'bar'], $clone->config());
        $this->assertEquals(['a' => 'a'], $clone->container());
        $this->assertEquals(['b' => 'b'], $clone->events());
        $this->assertEquals(['baz' => 'bat'], $clone->services());
    }

    /**
     *
     */
    function test_with_config_object()
    {
        $app = new App;
        $app->config(new Config);

        $clone = clone $app;

        $this->assertTrue($clone == $app);

        $config = $clone->config();
        $config['foo'] = 'bar';

        $this->assertFalse($clone == $app);
        $this->assertEquals(new Config, $app->config());
        $this->assertEquals(new Config(['foo' => 'bar']), $clone->config());
    }

    /**
     *
     */
    function test_with_container_object()
    {
        $app = new App([Arg::CONTAINER => new Config]);

        $clone = clone $app;

        $this->assertTrue($clone == $app);

        $container = $clone->container();
        $container['a'] = 'a';

        $this->assertFalse($clone == $app);
        $this->assertEquals(new Config, $app->container());
        $this->assertEquals(new Config(['a' => 'a']), $clone->container());

        $this->assertNull($clone['b']);

        $clone->config()[Arg::CONTAINER]['b'] = 'b';

        $this->assertEquals('b', $clone['b']);
        $this->assertTrue($clone->container() === $clone->config()[Arg::CONTAINER]);
    }

    /**
     *
     */
    function test_with_events_object()
    {
        $app = new App([Arg::EVENTS => new Config]);

        $clone = clone $app;

        $this->assertTrue($clone == $app);

        $events = $clone->events();
        $events['a'] = 'a';

        $this->assertFalse($clone == $app);
        $this->assertEquals(new Config, $app->events());
        $this->assertEquals(new Config(['a' => 'a']), $clone->events());

        $this->assertNull($clone->events()['b']);

        $clone->config()[Arg::EVENTS]['b'] = 'b';

        $this->assertEquals('b', $clone->events()['b']);
        $this->assertTrue($clone->events() === $clone->config()[Arg::EVENTS]);
    }

    /**
     *
     */
    function test_with_objects()
    {
        $app = new App;

        $app->config(new Config);
        $app->container(new Config);
        $app->events(new Config);
        $app->services(new Config);

        $clone = clone $app;

        $this->assertTrue($clone == $app);

        $config    = $clone->config();
        $container = $clone->container();
        $events    = $clone->events();
        $services  = $clone->services();

        $config['foo']   = 'bar';
        $container['a']  = 'a';
        $events['b']     = 'b';
        $services['baz'] = 'bat';

        $this->assertFalse($clone == $app);

        $this->assertEquals(new Config, $app->config());
        $this->assertEquals(new Config, $app->container());
        $this->assertEquals(new Config, $app->events());
        $this->assertEquals(new Config, $app->services());
        $this->assertEquals(new Config(['foo' => 'bar']), $clone->config());
        $this->assertEquals(new Config(['a' => 'a']), $clone->container());
        $this->assertEquals(new Config(['b' => 'b']), $clone->events());
        $this->assertEquals(new Config(['baz' => 'bat']), $clone->services());
    }

    /**
     *
     */
    function test_with_services_object()
    {
        $app = new App([Arg::SERVICES => new Config]);

        $clone = clone $app;

        $this->assertTrue($clone == $app);

        $services = $clone->services();
        $services['baz'] = 'bat';

        $this->assertFalse($clone == $app);
        $this->assertEquals(new Config, $app->services());
        $this->assertEquals(new Config(['baz' => 'bat']), $clone->services());

        $this->assertNull($clone->services()['b']);

        $clone->config()[Arg::SERVICES]['b'] = 'b';

        $this->assertEquals('b', $clone->services()['b']);
        $this->assertTrue($clone->services() === $clone->config()[Arg::SERVICES]);
    }
}
