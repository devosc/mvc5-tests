<?php
/**
 *
 */

namespace Mvc5\Test\Resolver;

use Mvc5\App;
use Mvc5\Session\PHPSession;
use Mvc5\Test\Test\TestCase;

class SerializeTest
    extends TestCase
{
    /**
     *
     */
    function test_serialize()
    {
        $config = [
            'container' => [
                'baz' => 'bat'
            ],
            'events' => [
                'bar' => 'baz'
            ]
        ];

        $app = new App($config, null, true);

        $serialized = serialize($app);
        $this->assertTrue(is_string($serialized));

        $app = unserialize($serialized);
        $this->assertEquals($config, $app->config());
        $this->assertTrue($app->scope());
    }

    /**
     * @runInSeparateProcess
     */
    function test_unserialize()
    {
        $session = new PHPSession;

        $session->start();

        $config = [
            'container' => [
                'baz' => 'bat'
            ],
            'events' => [
                'foo' => 'bar'
            ]
        ];

        $app = new App($config, null, true);

        $session['resolver'] = $app;

        $session->close();

        $session->start();

        $app = $session['resolver'];
        $this->assertEquals($config, $app->config());
        $this->assertEmpty($app->container());
        $this->assertEquals(['foo' => 'bar'], $app->events());
        $this->assertTrue($app->scope());

        $session->destroy();
    }
}
