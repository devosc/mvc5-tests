<?php
/**
 *
 */

namespace Mvc5\Test\Resolver;

use Mvc5\App;
use Mvc5\Config;
use Mvc5\Test\Test\TestCase;

final class GetTest
    extends TestCase
{
    /**
     *
     */
    function test_null()
    {
        $this->assertNull((new App)->get('foo'));
    }

    /**
     *
     */
    function test_plugin()
    {
        $this->assertEquals(new Config, (new App)->get(Config::class));
    }

    /**
     *
     */
    function test_stored()
    {
        $app = new App([
            'container' => [
                'foo' => 'bar'
            ]
        ]);

        $this->assertEquals('bar', $app->get('foo'));
    }
}
