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

        $this->assertEquals('bat', $app['baz']);

        $serialized = serialize($app);
        $this->assertTrue(is_string($serialized));

        $app = unserialize($serialized);
        $this->assertNull($app['baz']);
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
        ];

        $app = new App($config, null, true);

        $this->assertEquals('bat', $app['baz']);

        $session['resolver'] = $app;

        $session->close();

        $session->start();

        $app2 = $session['resolver'];

        $this->assertInstanceOf(App::class, $app2);
        $this->assertNotSame($app, $app2);
        $this->assertNull($app2['baz']);
        $this->assertTrue($app->scope());

        $session->destroy();
    }
}
