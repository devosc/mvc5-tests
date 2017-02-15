<?php
/**
 *
 */

namespace Mvc5\Test\Resolver;

use Mvc5\App;
use Mvc5\Test\Test\TestCase;

class HasTest
    extends TestCase
{
    /**
     *
     */
    function test_has_configuration()
    {
        $app = new App([
            'services' => [
                'foo' => 'bar'
            ]
        ]);

        $this->assertTrue($app->has('foo'));
    }

    /**
     *
     */
    function test_has_service()
    {
        $app = new App([
            'container' => [
                'foo' => 'bar'
            ]
        ]);

        $this->assertTrue($app->has('foo'));
    }
}
