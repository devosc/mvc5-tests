<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Initializer;

use Mvc5\App;
use Mvc5\Config;
use Mvc5\Plugin\Plugin;
use Mvc5\Plugin\Shared;
use Mvc5\Test\Test\TestCase;

class InitializerTest
    extends TestCase
{
    /**
     *
     */
    function test_circular_dependency_exception()
    {
        $app = new App(['services' => ['foo' => new Shared('foo', new Plugin('foo'))]]);

        $this->setExpectedException('RuntimeException', 'Circular dependency: foo');

        $app->get('foo');
    }

    /**
     *
     */
    function test_initialized()
    {
        $app = new App;

        $this->assertNull($app->get('foo'));
        $this->assertInstanceOf(Config::class, $app->plugin(new Shared('foo', Config::class)));
        $this->assertInstanceOf(Config::class, $app->get('foo'));
    }
}
