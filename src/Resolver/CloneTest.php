<?php
/**
 *
 */

namespace Mvc5\Test\Resolver;

use Mvc5\App;
use Mvc5\Arg;
use Mvc5\Config;
use Mvc5\Container;
use Mvc5\Model;
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
        $config = [
            'foo' => 'bar',
            'services' => [
                'config' => new \Mvc5\Plugin\Config
            ]
        ];

        $app = new App($config);

        $clone = clone $app;

        $this->assertEquals($clone, $app);

        $clone->set('a', 'a2');

        $this->assertNotSame($clone, $app);

        $this->assertEquals(new Model($config), $app['config']);
        $this->assertEquals(new Model($config), $clone['config']);
        $this->assertNull($app['a']);
        $this->assertEquals('a2', $clone['a']);
    }

    /**
     *
     */
    function test_with_config_object()
    {
        $app = new App(new Config);

        $clone = clone $app;

        $this->assertEquals($clone, $app);
        $this->assertNotSame($clone, $app);
    }

    /**
     *
     */
    function test_with_container_object()
    {
        $app = new App([
            Arg::CONTAINER => new Container(['a' => 'a1'])
        ]);

        $clone = clone $app;

        $this->assertEquals($clone, $app);

        $clone['b'] = 'b1';

        $this->assertNotSame($clone, $app);
        $this->assertEquals('a1', $app['a']);
        $this->assertEquals('a1', $clone['a']);
        $this->assertNull($app['b']);
        $this->assertEquals('b1', $clone['b']);
    }

    /**
     *
     */
    function test_with_events_object()
    {
        $app = new App([Arg::EVENTS => new Config]);

        $clone = clone $app;

        $this->assertEquals($clone, $app);
        $this->assertNotSame($clone, $app);
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
    }

    /**
     *
     */
    function test_with_services_object()
    {
        $app = new App([Arg::SERVICES => new Config]);

        $clone = clone $app;

        $this->assertEquals($clone, $app);
        $this->assertNotSame($clone, $app);
    }
}
