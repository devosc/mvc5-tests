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

        $app['a'] = $a;

        $clone = clone $app;

        $this->assertEquals($clone, $app);
        $this->assertInstanceOf(\stdClass::class, $clone->get('a'));
        $this->assertEquals($a, $clone->get('a'));
        $this->assertSame($a, $clone->get('a'));
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
        $app = new App([
            'foo' => 'bar',
        ]);

        $clone = clone $app;

        $this->assertEquals($clone, $app);

        $clone->set('a', 'a');

        $this->assertNotSame($clone, $app);

        $this->assertEquals(['foo' => 'bar'], $app->config());
        $this->assertEquals([], $app->container());
        $this->assertEquals(['foo' => 'bar'], $clone->config());
        $this->assertEquals(['a' => 'a'], $clone->container());
    }

    /**
     *
     */
    function test_with_config_object()
    {
        $app = new App(new Config);

        $clone = clone $app;

        $this->assertEquals($clone, $app);

        $config = $clone->config();
        $config['foo'] = 'bar';

        $this->assertNotSame($clone, $app);
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

        $this->assertEquals($clone, $app);

        $container = $clone->container();
        $container['a'] = 'a';

        $this->assertNotSame($clone, $app);
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

        $this->assertEquals($clone, $app);

        $events = $clone->events();
        $events['a'] = 'a';

        $this->assertNotSame($clone, $app);
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
        $config = new Config([
            'container' => new Config,
            'events' => new Config,
            'services' => new Config
        ]);

        $app = new App($config);

        $clone = clone $app;

        $this->assertEquals($clone, $app);
        $this->assertNotSame($clone, $app);
        $this->assertEquals($clone->config(), $app->config());
        $this->assertNotSame($clone->config(), $app->config());
        $this->assertEquals($clone->container(), $app->container());
        $this->assertNotSame($clone->container(), $app->container());
        $this->assertEquals($clone->events(), $app->events());
        $this->assertNotSame($clone->events(), $app->events());
        $this->assertEquals($clone->services(), $app->services());
        $this->assertNotSame($clone->services(), $app->services());
    }

    /**
     *
     */
    function test_with_services_object()
    {
        $app = new App([Arg::SERVICES => new Config]);

        $clone = clone $app;

        $this->assertEquals($clone, $app);

        $services = $clone->services();
        $services['baz'] = 'bat';

        $this->assertNotSame($clone, $app);
        $this->assertEquals(new Config, $app->services());
        $this->assertEquals(new Config(['baz' => 'bat']), $clone->services());

        $this->assertNull($clone->services()['b']);

        $clone->config()[Arg::SERVICES]['b'] = 'b';

        $this->assertEquals('b', $clone->services()['b']);
        $this->assertTrue($clone->services() === $clone->config()[Arg::SERVICES]);
    }
}
