<?php
/**
 *
 */

namespace Mvc5\Test\Resolver;

use Mvc5\App;
use Mvc5\Session\Config as Session;
use Mvc5\Test\Test\TestCase;

class SerializeTest
    extends TestCase
{
    /**
     *
     */
    function test_serialize()
    {
        $app = new App(null, null, true);

        $config = ['foo' => 'bar'];
        $app->config($config);

        $container = ['baz' => function() {}];
        $app->container($container);

        $events = ['bar' => 'baz'];
        $app->events($events);

        $serialized = serialize($app);
        $this->assertTrue(is_string($serialized));

        $app = unserialize($serialized);
        $this->assertEquals($config, $app->config());
        $this->assertEmpty($app->container());
        $this->assertEquals($events, $app->events());
        $this->assertTrue($app->scope());
    }

    /**
     * @runInSeparateProcess
     */
    function test_unserialize()
    {
        $session = new Session;

        $session->start();

        $app = new App(null, null, true);

        $config = ['foo' => 'bar'];
        $app->config($config);

        $container = ['baz' => function() {}];
        $app->container($container);

        $events = ['bar' => 'baz'];
        $app->events($events);

        $session['resolver'] = $app;

        $session->close();

        $session->start();

        $app = $session['resolver'];
        $this->assertEquals($config, $app->config());
        $this->assertEmpty($app->container());
        $this->assertEquals($events, $app->events());
        $this->assertTrue($app->scope());

        $session->destroy();
    }
}
